<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Receptionist extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'mobile_phone',
        'home_phone',
        'address',
        'image_url',
    ];

    protected $appends = [
        'name',
        'signed_image_url'
    ];

    /**
     * function for get full name of receptionist
     *
     * @return string
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * function for get full url of image
     *
     * @return string
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getSignedImageUrlAttribute()
    {
        if (!empty($this->image_url)) {
            return asset('storage' . $this->image_url);
        }
    }

    /**
     * function for get realtionshi with User
     *
     * @return object
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
