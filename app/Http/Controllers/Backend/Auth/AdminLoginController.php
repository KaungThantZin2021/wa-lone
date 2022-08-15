<?php

namespace App\Http\Controllers\Backend\Auth;

use Carbon\Carbon;
use App\Models\AdminUser;
use Illuminate\Http\Request;
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

        // $this->validateLogin($request);

        // if ($request->otp == null) {
        //     return 'kdd';
        // }

        // if ($request->all()) {
        //     dd($request->all());
        // }
        
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'otp' => 'required|numeric|digits:6'
        ]);
        dd('vgddddddddddd');


        if ($request->otp != 123123) {
            return redirect()->back()->withError('OTP doesn\'t match.');
        }

        $session_array = session()->get(config('otp.key'));

        $session = (object) $session_array;

        if ($request->email != $session->email || $request->password != $session->password) {
            dd('vgdsh');
            return redirect()->back()->withError('Invalid Data!');
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

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function showOtpForm(Request $request)
    {
        $this->validateLogin($request);

        $admin_user = AdminUser::where('email', $request->email)->first();

        if (!is_null($admin_user)) {
            if (Hash::check($request->password, $admin_user->password)) {
    
                session()->put(config('otp.key'), [
                    'email' => $admin_user->email,
                    'password' => $request->password
                ]);

                $session_array = session()->get(config('otp.key'));

                $session = (object) $session_array;
    
                // return redirect()->route('admin.otp');
                return view('backend.auth.admin_otp', compact('session'));

            }
        }

        return redirect()->back()->withError('Credentials doesn\'t match.');

        
        // if ($request->otp != 123123) {
        //     return redirect()->back()->withError('OTP doesn\'t match.');
        // }

        // $session_array = session()->get(config('otp.key'));

        // $session = (object) $session_array;

        // if ($request->email != $session->email || $request->password != $session->password) {
        //     return redirect()->back()->withError('Invalid Data!');
        // }

        // dd($request->all());

        // if (!session(config('otp.key'))) {
        //     return redirect()->back('Invalid data.');
        // }

        // $session_array = session()->get(config('otp.key'));

        // $session = (object) $session_array;

        // $admin_user = AdminUser::where('email', $session->email)->first();

        // if (is_null($admin_user)) {
        //     return redirect()->back()->withError('Invalid data.');
        // }
        
        // return view('backend.auth.admin_otp', compact('session'));

    }

    protected function authenticated(Request $request, $user)
    {
        return redirect($this->redirectTo);
    }
}
