<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'numeric|nullable|unique:users,phone,' . $this->user->phone . ',phone',
            'email' => 'required|email|unique:users,email,' . $this->user->email . ',email',
            'gender' => 'required',
            'dob' => 'required|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'dob.required' => 'The date of birth field is required.',
            'dob.date_format' => 'The date of birth field does not match the format Y-m-d.',
        ];
    }
}
