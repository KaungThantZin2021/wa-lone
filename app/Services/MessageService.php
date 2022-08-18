<?php

namespace App\Services;

use Carbon\Carbon;
use App\Mail\OTPMail;
use App\Models\OTPCode;
use Illuminate\Support\Facades\Mail;

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

    public static function sendEmail($to_email, $otp)
    {
        Mail::to($to_email)->send(new OTPMail($otp));

        return 'A message has been sent to Mailtrap!';
    }
}
