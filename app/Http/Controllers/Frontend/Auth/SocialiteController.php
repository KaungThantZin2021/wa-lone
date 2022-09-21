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
        // if ($provider == 'facebook') {
        //     return Socialite::driver('facebook')->fields(['phone'])->redirect();
        // }
        return Socialite::driver($provider)->redirect();
    }

    public function callback(Request $request, $provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        // dd($user);
        // dd($user->token);

        if (!$user) {
            return redirect()->back()->withErrors('Invalid Data!')->withInput();
        }

        $existing_user = User::where('email', $user->email)->first();

        if ($existing_user) {
            auth()->login($existing_user, true);
            return redirect()->route('home');
        } else {
            try {
                $now = Carbon::now()->format('Y-m-d H:i:s');
    
                $user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $now,
                    'password' => Hash::make($user->name.'@'.$user->id),
                    'provider_id' => $user->id,
                    'provider' => $provider,
                ]);
    
                auth()->login($user, true);
                return redirect()->route('home');
    
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
}