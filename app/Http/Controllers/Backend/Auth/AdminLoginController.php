<?php

namespace App\Http\Controllers\Backend\Auth;

use Carbon\Carbon;
use App\Rules\OtpRule;
use App\Models\OTPCode;
use App\Models\AdminUser;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Services\MessageService;
use App\Rules\OtpExpireCheckRule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
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

    // protected $otp = env('OTP_KEY', 'otp');
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin_user')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin_user');
    }

    public function showLoginForm()
    {
        return view('backend.auth.admin_login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        
        $request->validate([
            'otp' => ['required', 'numeric', 'digits:6', new OtpRule, new OtpExpireCheckRule]
        ]);
        
        $session = $this->getSession();
        
        $otp = OTPCode::latestOtp($session);

        if ($request->otp != $otp) {
            return redirect()->back()->with('error', 'OTP doesn\'t match.');
        }

        if ($request->email != $session->email || $request->password != $session->password) {
            return redirect()->back()->with('error', 'Invalid Data!');
        }

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            $this->deleteOtp();

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function twoStepOtp(Request $request)
    {
        $this->validateLogin($request);

        $admin_user = AdminUser::where('email', $request->email)->first();

        if (!is_null($admin_user)) {
            if (Hash::check($request->password, $admin_user->password)) {
                
                $otp = MessageService::otpGenerate();
                MessageService::otpStore($request->email, $otp);
                MessageService::sendEmail($request->email, $otp);

                session()->put(config('otp.key'), [
                    'email' => $admin_user->email,
                    'password' => $request->password,
                    'otp' => $otp
                ]);
    
                return redirect()->route('admin.otp');
            }
        }
        return redirect()->back()->withError('Credentials doesn\'t match.');
    }

    public function showOtpForm()
    {
        $session = $this->getSession();

        return view('backend.auth.admin_otp', compact('session'));
    }

    public function resendOtp()
    {
        $this->deleteOtp();

        $session = $this->getSession();

        $otp = MessageService::otpGenerate();
        MessageService::otpStore($session->email, $otp);
        MessageService::sendEmail($session->email, $otp);

        session()->put(config('otp.key'), [
            'email' => $session->email,
            'password' => $session->password,
            'otp' => $otp
        ]);

        return response()->json([
            'result' => 1,
            'message' => 'We sent a new OTP email. Please Check Your email.'
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        $agent = new Agent();
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $user->email_verified_at = $now;
        $user->remember_token = $request->_token;
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
        $session = (object) session()->get(config('otp.key'));

        return $session;
    }

    protected function deleteOtp()
    {
        $session = $this->getSession();
        
        $otp_code = OTPCode::where('email', $session->email)->where('otp', $session->otp)->latest()->first();

        if ($otp_code) {
            $otp_code->delete();
        }

        return;
    }
}
