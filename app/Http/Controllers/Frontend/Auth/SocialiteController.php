<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function provider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        dd($user);
        // $user->token

        // if ($user) {
        //     User::create([
        //         'name' => $user->getName(),
        //         'email' => $user->getEmail()
        //     ]);
        // }
    }
}