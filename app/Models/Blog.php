<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'thumbnail_type',
        'thumbnail',
        'description',
    ];

    const THUMBNAIL_TYPE = ['file', 'url'],
    THUMBNAIL_FILE = self::THUMBNAIL_TYPE[0],
    THUMBNAIL_URL = self::THUMBNAIL_TYPE[1];

    public function thumbnailPath()
    {
        return asset('thumbnails/' . $this->thumbnail);
    }
}
