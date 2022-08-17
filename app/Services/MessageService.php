<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\OTPCode;

class  MessageService
{
    public static function otpGenerate()
    {
        $otp = mt_rand(100000, 999999);

        return $otp;
    }

    public static function otpStore($email, $otp)
    {
        OTPCode::create([
            'email' => $email,
            'otp' => $otp,
            'expire_at' => Carbon::now()->addMinutes(5)->timestamp
        ]);
        
        return;
    }
}
