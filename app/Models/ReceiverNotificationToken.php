<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceiverNotificationToken extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    CONST PLATFORM = ['website', 'mobile'],
    WEBSITE = self::PLATFORM[0],
    MOBILE = self::PLATFORM[1];
}
