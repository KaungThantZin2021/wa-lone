<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ThumbnailUrlFileTypeCheckRule;

class UpdateBlogRequest extends FormRequest
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
        // dd($this->thumbnail_check);

        // $thumbnail_check = [];

        // if ($this->thumbnail_check == 1) {
        //     $thumbnail_check = ['required_if:thumbnail_type,' . Blog::THUMBNAIL_FILE, 'mimes:png,jpg,jpeg,gif|max:2048'];
        // }

        return [
            'title' => 'required',
            'thumbnail_type' => 'required',
            'thumbnail_file' => [$this->thumbnail_check != 1 ? 'required_if:thumbnail_type,' . Blog::THUMBNAIL_FILE : '', 'mimes:png,jpg,jpeg,gif|max:2048'],
            'thumbnail_url' => [$this->thumbnail_check != 1 ? 'required_if:thumbnail_type,'  . Blog::THUMBNAIL_URL : '', new ThumbnailUrlFileTypeCheckRule(['png', 'jpg', 'jpeg', 'gif'])],
            'description' => 'required'
        ];
    }
}
