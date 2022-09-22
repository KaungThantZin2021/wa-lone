<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\OTPCode;
use App\Jobs\OTPMailJob;

class  MessageService
{
    public static function otpGenerate()
    {
        if (config('app.env') != 'production') {
            return 123123;
        } 

        return mt_rand(100000, 999999);
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
        $email_data = [
            'to_email' => $to_email,
            'otp' => $otp
        ];

        OTPMailJob::dispatch($email_data);

        return 'A message has been sent to Mailtrap!';
    }
}
