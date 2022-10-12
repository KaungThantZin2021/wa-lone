<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use App\Models\OTPCode;
use Illuminate\Http\Request;
use App\Services\MessageService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\User\OTPCodeRequest;
use App\Http\Requests\User\NewPasswordRequest;
use App\Http\Requests\User\ForgetPasswordRequest;

class ForgetPasswordController extends Controller
{
    protected $redirectToUserLogin = RouteServiceProvider::USER_LOGIN;

    public function forgetPassword()
    {
        return view('frontend.auth.forget_password.forget_password');
    }

    public function sendRequest(ForgetPasswordRequest $request)
    {
        if ($request->email) {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $otp = MessageService::otpGenerate();
                MessageService::otpStore($user->email, $otp);
                MessageService::sendEmail($user->email, $otp);

                session()->put(config('otp.forget_password'), ['email' => $user->email, 'otp' => $otp]);

                return redirect()->route('otp-for-new-password');
            }
        }

        return redirect()->back();
    }

    public function otpForNewPassword()
    {
        $session = $this->getSession();
        $email = $session->email;
        return view('frontend.auth.forget_password.otp_for_new_password', compact('email'));
    }

    public function newPassword(OTPCodeRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $otp = OTPCode::where('email', $user->email)->where('otp', $request->otp)->latest()->first();

            if ($otp) {
                $session = $this->getSession();
                return view('frontend.auth.forget_password.new_password', compact('session'));
            }
        }

        return redirect()->back();
    }

    public function changePassword(NewPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $otp = OTPCode::where('email', $user->email)->where('otp', $request->otp)->latest()->first();

            if ($otp) {
                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);
            }
        }

        return redirect($this->redirectToUserLogin);
    }

    private function getSession()
    {
        $session = (object) session()->get(config('otp.forget_password'));

        return $session;
    }
}
