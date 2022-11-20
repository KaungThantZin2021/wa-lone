<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use App\Models\OTPCode;
use App\Jobs\OTPMailJob;
use Illuminate\Support\Facades\DB;

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
        $store = OTPCode::create([
            'email' => $email,
            'otp' => $otp,
            'expire_at' => Carbon::now()->addSeconds($expire_duration)->timestamp
        ]);

        if ($store) return true;

        return false;
    }

    public static function sendEmail(string $to_email, int $otp)
    {
        $email_data = [
            'to_email' => $to_email,
            'otp' => $otp
        ];

        if (!$email_data) return fail('Something wrong! OTP Mail cannot send.');

        OTPMailJob::dispatch($email_data);

        return success('OTP Mail have been send, Check your mail (' . $to_email . ')');
    }

    public static function deleteOTP(object $session)
    {
        $otp_code = OTPCode::where('email', $session->email)->where('otp', $session->otp)->latest()->first();

        if (!$otp_code) return fail('Something wrong! There is no old OTP code to delete.');

        $otp_code->delete();

        return success('OTP code have been deleted.');
    }

    public static function OTPExpireDuration(object $session, int $expire_duration)
    {
        $otp_code = OTPCode::where('email', $session->email)->where('otp', $session->otp)->first();

        if (!$otp_code) return fail('Something wrong! OTP code error to check remaining OTP expire time.');

        $remain_seconds = $expire_duration;

        if (Carbon::now()->gt(Carbon::parse($otp_code->expire_at)->format('Y-m-d H:i:s'))) {
            $remain_seconds = Carbon::now()->diffInSeconds(Carbon::parse($otp_code->expire_at));
        }

        return success('', ['remain_seconds' => $remain_seconds]);
    }

    public static function OTPSendingProcess(string $email, int $expire_duration)
    {
        DB::beginTransaction();
        try {
            $otp = self::generateOTP();
            $store = self::storeOTP($email, $otp, $expire_duration);

            if (!$store) throw new Exception("Something wrong!");

            $result = self::sendEmail($email, $otp);

            if ($result['result'] != 1) throw new Exception($result['message']);

            DB::commit();
            return success($result['message'], ['otp' => $otp]);

        } catch (Exception $e) {
            DB::rollback();
            return fail($e->getMessage());
        }
    }
}
