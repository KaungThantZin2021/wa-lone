<?php

namespace App\Models;

use App\Traits\Uuids;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Uuids, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'provider_id',
        'provider',
        'gender',
        'dob',
        'profile_photo',
        'cover_photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profilePhotoPath()
    {
        return asset('crop/' . $this->profile_photo);
    }

    public function originalProfilePhotoPath()
    {
        return asset('user_files/' . $this->profile_photo);
    }

    public function originalCoverPhotoPath()
    {
        return asset('user_files/' . $this->cover_photo);
    }
}
