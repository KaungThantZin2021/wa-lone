<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ThumbnailUrlFileTypeCheckRule implements Rule
{
    private $accept_file_type_array;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $accept_file_type_array)
    {
        $this->accept_file_type_array = $accept_file_type_array;
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
        $file_ext = pathinfo($value, PATHINFO_EXTENSION);

        return in_array($file_ext, $this->accept_file_type_array);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invaild File Data! The :attribute field is accept only "' . implode(', ', $this->accept_file_type_array) . '".';
    }
}
