<?php

namespace App\Http\Controllers\Backend\Auth;

use Carbon\Carbon;
use App\Rules\OTPRule;
use App\Models\OTPCode;
use App\Models\AdminUser;
use Jenssegers\Agent\Agent;
use App\Services\OTPService;
use Illuminate\Http\Request;
use App\Rules\OTPExpireCheckRule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Requests\Admin\AdminOTPLoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    protected $otp_key;
    protected $otp_expire_duration;

    protected $maxAttempts = 5; // Default is 5
    protected $decayMinutes = 1; // Default is 1

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin_user')->except('logout');
        $this->otp_key = config('otp.key');
        $this->otp_expire_duration = config('otp.expire_duration');
    }

    protected function guard()
    {
        return Auth::guard('admin_user');
    }

    public function showLoginForm()
    {
        return view('backend.auth.admin_login');
    }

    public function login(AdminLoginRequest $request)
    {
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $this->validateLogin($request);

        $admin_user = AdminUser::where('email', $request->email)->first();

        if (is_null($admin_user)) return redirect()->back()->withErrors(['fail' => 'Credentials doesn\'t match.'])->withInput();

        if (Hash::check($request->password, $admin_user->password)) {

            $result = OTPService::OTPSendingProcess($request->email, $this->otp_expire_duration);

            if ($result['result'] == 1) {
                session()->put($this->otp_key, [
                    'email' => $admin_user->email,
                    'password' => $request->password,
                    'otp' => $result['data']['otp']
                ]);

                return redirect()->route('admin.otp');
            }

            return redirect()->back()->withErrors(['fail' => 'Something wrong!'])->withInput();
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function twoStepLogin(AdminOTPLoginRequest $request)
    {
        $this->validateLogin($request);

        $request->validate([
            'otp' => ['required', 'numeric', 'digits:6', new OTPRule, new OTPExpireCheckRule]
        ]);

        $session = $this->getSession();

        $otp = OTPCode::latestOTP($session);

        if ($request->otp != $otp) {
            return redirect()->back()->withErrors(['fail' => 'OTP doesn\'t match.'])->withInput();
        }

        if ($request->email != $session->email || $request->password != $session->password) {
            return redirect()->back()->withErrors(['fail' => 'Invalid Data!'])->withInput();
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            OTPService::deleteOTP($session);

            return $this->sendLoginResponse($request);
        }
    }

    public function showOTPForm()
    {
        $session = $this->getSession();

        $result = OTPService::OTPExpireDuration($session, $this->otp_expire_duration);

        if ($result['result'] == 1) {
            $remain_seconds = $result['data']['remain_seconds'];
            return view('backend.auth.admin_otp', compact('session', 'remain_seconds'));
        }

        return redirect()->back()->withErrors(['fail' => $result['message']])->withInput();
    }

    public function resendOTP()
    {
        $session = $this->getSession();

        // $result = OTPService::checkResendOTPAttempts($session);

        // if ($result['result'] == 0) {
        //     return fail($result['message']);
        // }

        OTPService::deleteOTP($session);

        $result = OTPService::OTPSendingProcess($session->email, $this->otp_expire_duration);

        if ($result['result'] == 1) {
            session()->put($this->otp_key, [
                'email' => $session->email,
                'password' => $session->password,
                'otp' => $result['data']['otp']
            ]);

            session()->flash('resend-otp', $result['message']);

            return success($result['message']);
        }

        return fail('Something wrong!');
    }

    protected function authenticated(Request $request, $user)
    {
        $agent = new Agent();
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $user->email_verified_at = $now;
        $user->ip = $request->ip();
        $user->device = $agent->device();
        $user->browser = $agent->browser();
        $user->platform = $agent->platform();
        $user->login_at = $now;
        $user->update();

        return redirect($this->redirectTo);
    }

    protected function getSession()
    {
        $session = (object) session()->get($this->otp_key);

        return $session;
    }
}
