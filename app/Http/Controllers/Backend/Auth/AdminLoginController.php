<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

    // public function login(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if(auth()->guard('admin')->attempt([
    //         'email' => $request->email,
    //         'password' => $request->password,
    //     ])) {
    //         $user = auth()->user();

    //         dd($user);

    //         return redirect()->intended(url('/admin/dashboard'));
    //     } else {
    //         return redirect()->back()->withError('Credentials doesn\'t match.');
    //     }
    // }

    protected function authenticated(Request $request, $user)
    {
        return redirect($this->redirectTo);
    }
}
