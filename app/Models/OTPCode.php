<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTPCode extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'email', 'otp', 'expire_at'];

    public function scopelatestOTP($query, $session)
    {
        return $query->where('email', $session->email)->where('otp', $session->otp)->latest()->first()->otp;
    }
}
