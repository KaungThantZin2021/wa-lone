<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\Showroom;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * The showrooms that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function showrooms(): BelongsToMany
    {
        return $this->belongsToMany(Showroom::class, 'showroom_users_table', 'user_id', 'showroom_id');
    }

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
