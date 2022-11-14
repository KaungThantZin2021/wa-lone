<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\OTPCode;
use App\Jobs\OTPMailJob;

class  OTPService
{
    public static function generateOTP()
    {
        if (config('app.env') != 'production') {
            return 123123;
        }

        return mt_rand(100000, 999999);
    }

    public static function storeOTP(string $email, int $otp, int $expire_duration)
    {
        OTPCode::create([
            'email' => $email,
            'otp' => $otp,
            'expire_at' => Carbon::now()->addSeconds($expire_duration)->timestamp
        ]);

        return;
    }

    public static function sendEmail(string $to_email, int $otp)
    {
        $email_data = [
            'to_email' => $to_email,
            'otp' => $otp
        ];

        OTPMailJob::dispatch($email_data);

        return 'A message has been sent to Mailtrap!';
    }

    public static function deleteOTP(object $session)
    {
        $otp_code = OTPCode::where('email', $session->email)->where('otp', $session->otp)->latest()->first();

        if ($otp_code) {
            $otp_code->delete();
        }

        return 'A message has been sent to Mailtrap!';
    }

    public static function OTPExpireDuration(object $session, int $expire_duration)
    {
        $otp_timer = OTPCode::where('email', $session->email)->where('otp', $session->otp)->first();

        $remain_seconds = $expire_duration;

        if (Carbon::now()->gt(Carbon::parse($otp_timer->expire_at)->format('Y-m-d H:i:s'))) {
            $remain_seconds = Carbon::now()->diffInSeconds(Carbon::parse($otp_timer->expire_at));
        }

        return $remain_seconds;
    }

    public static function OTPSendingProcess(string $email, int $expire_duration)
    {
        $otp = self::generateOTP();
        self::storeOTP($email, $otp, $expire_duration);
        self::sendEmail($email, $otp);

        return $otp;
    }
}
