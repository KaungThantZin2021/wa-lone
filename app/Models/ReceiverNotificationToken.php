<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function scopeWebsite($query)
    {
        return $query->where('platform', self::WEBSITE);
    }

    public function scopeIsExpired($query, bool $boolean)
    {
        $now = Carbon::parse()->now()->format('Y-m-d H:i:s');
        if ($boolean) {
            return $query->where('expire_at', '<', $now);
        }

        return $query->where('expire_at', '>', $now);
    }
}
