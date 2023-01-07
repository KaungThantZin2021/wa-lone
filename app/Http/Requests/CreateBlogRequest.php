<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ThumbnailUrlFileTypeCheckRule;

class CreateBlogRequest extends FormRequest
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
            'title' => 'required',
            'thumbnail_type' => 'required',
            'thumbnail_file' => 'required_if:thumbnail_type,' . Blog::THUMBNAIL_FILE . '|mimes:png,jpg,jpeg,gif|max:2048',
            'thumbnail_url' =>  ['required_if:thumbnail_type,'  . Blog::THUMBNAIL_URL, new ThumbnailUrlFileTypeCheckRule(['png', 'jpg', 'jpeg', 'gif'])],
            'description' => 'required'
        ];
    }
}
