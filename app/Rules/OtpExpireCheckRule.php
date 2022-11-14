<?php

namespace App\Rules;

use Carbon\Carbon;
use App\Models\OTPCode;
use Illuminate\Contracts\Validation\Rule;

class OTPExpireCheckRule implements Rule
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
        $now = Carbon::now()->timestamp;
        $expire_at = OTPCode::where('otp', $value)->first()->expire_at;

        return $expire_at >= $now;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'OTP was expired. To get new OTP again, click "Resend OTP".';
    }
}
