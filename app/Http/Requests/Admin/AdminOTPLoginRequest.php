<?php

namespace App\Http\Requests\Admin;

use App\Rules\OTPRule;
use App\Rules\OTPExpireCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminOTPLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:admin_users,email',
            'password' => 'required',
            'otp' => ['required', 'numeric', 'digits:6', new OTPRule, new OTPExpireCheckRule]
        ];
    }
}
