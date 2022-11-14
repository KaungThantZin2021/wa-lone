<?php

return [
    'key' => env('OTP_KEY', 'otp'),
    'expire_duration' => env('OTP_EXPIRE_DURATION', 60),

    'forget_password' => 'forget_password',
];
