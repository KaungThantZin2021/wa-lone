<?php
namespace App\Http\Controllers\Frontend\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function provider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(Request $request, $provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        // dd($user);
        // $user->token

        if ($provider == config('socialite.provider.facebook')) {

            if ($user) {
                try {
                    $now = Carbon::now()->format('Y-m-d H:i:s');
                    $user = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'email_verified_at' => $now,
                        'password' => Hash::make($user->name.'@'.$user->id),
                        'provider_id' => $user->id,
                        'provider' => config('socialite.provider.facebook'),
                        // 'remember_token' => $request->_token //is not working
                    ]);
    
                    auth()->login($user);
    
                    return redirect()->route('home');

                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }

        if ($provider == config('socialite.provider.google')) {

            if ($user) {
                try {
                    $now = Carbon::now()->format('Y-m-d H:i:s');
                    $user = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'email_verified_at' => $now,
                        'password' => Hash::make($user->name.'@'.$user->id),
                        'provider_id' => $user->id,
                        'provider' => config('socialite.provider.google'),
                        // 'remember_token' => $request->_token //is not working
                    ]);
    
                    auth()->login($user);
    
                    return redirect()->route('home');

                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }
    }
}