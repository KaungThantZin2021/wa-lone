<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Showroom extends Model
{
    use Uuids, HasFactory;

    protected $guarded = [];

    /**
     * The users that belong to the Showroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'showroom_users_table', 'showroom_id', 'user_id');
    }

    public function profilePhotoPath()
    {

        return 'https://d1mgeijqpfaspl.cloudfront.net/uploads/bike/image_side/thumbs/628/6399e589302b3_IMG_2229.JPG';
        // return asset('crop/' . $this->profile_photo);
    }
}
