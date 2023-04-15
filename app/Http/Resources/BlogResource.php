<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => Str::limit($this->title, 70, ' ... <b class="hover:tw-underline">See more</b>'),
            'thumbnail_path' => $this->thumbnailPath(),
            'date' => $this->created_at->diffForHumans(),
            'detail_url' => route('blog.show', $this->id)
        ];
    }
}
