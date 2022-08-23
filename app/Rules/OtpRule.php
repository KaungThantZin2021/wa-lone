<?php

namespace App\Rules;

use App\Models\OTPCode;
use Illuminate\Contracts\Validation\Rule;

class OtpRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $session = (object) session()->get(config('otp.key'));
        $otp = OTPCode::latestOtpWithEmail($session->email);
        return $value == $otp;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'OTP doesn\'t match. Check your OTP code!';
    }
}
