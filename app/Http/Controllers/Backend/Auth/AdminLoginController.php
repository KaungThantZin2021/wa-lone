<?php

namespace App\Http\Controllers\Backend\Auth;

use Carbon\Carbon;
use App\Rules\OtpRule;
use App\Models\OTPCode;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Services\MessageService;
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
            'otp' => ['required', 'numeric', 'digits:6', new OtpRule]
        ]);
        
        $session = $this->getSession();
        
        $otp = OTPCode::latestOtpWithEmail($session->email);

        $now = Carbon::now()->timestamp;
        $expire_at = OTPCode::where('email', $session->email)->first()->expire_at;

        if ($expire_at < $now) {
            return redirect()->back()->with('error', 'OTP was expired. To get new OTP again, click "Resend OTP".');
        }

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
                    'password' => $request->password
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

    protected function authenticated(Request $request, $user)
    {
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
        
        OTPCode::where('email', $session->email)->latest()->first()->delete();
    }
}
