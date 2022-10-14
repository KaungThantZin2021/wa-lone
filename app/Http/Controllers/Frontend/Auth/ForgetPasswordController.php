<?php
namespace App\Http\Controllers\Frontend\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\ResetPasswordMailJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\ForgetPasswordRequest;

class ForgetPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('frontend.auth.forget_password');
    }

    public function submitForgetPasswordForm(ForgetPasswordRequest $request)
    {
        try {
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            ResetPasswordMailJob::dispatch($token, $request->email);

            return back()->with('success', 'We send Reset Password Link to your email (' . $request->email . '). Pleace Check your email.');

        } catch (\Exception $e) {
            return back()->with('error', 'Something Wrong (' . $e->getMessage() . ').');
        }
    }

    public function showResetPasswordForm($token)
    {
        return view('frontend.auth.reset_password', compact('token'));
    }

    public function submitResetPasswordForm(ResetPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $password_reset = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();

            if (!$password_reset) throw new Exception("The given data is invalid!");

            User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

            DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->delete();

            DB::commit();

            return redirect()->route('login')->with('success', 'Now, your password has been changed. You can login with new password.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something Wrong (' . $e->getMessage() .' ).');
        }
    }
}
