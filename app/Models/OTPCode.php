<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTPCode extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'email', 'otp', 'expire_at'];

    public function scopelatestOtpWithEmail($query, $email)
    {
        return $query->where('email', $email)->latest()->first()->otp;
    }
}
