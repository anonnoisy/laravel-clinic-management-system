<?php

namespace App\Models\User;

use App\Models\Department\Department;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'mobile_phone',
        'home_phone',
        'address',
        'department_id',
        'image_url',
        'profile',
    ];

    protected $appends = [
        'name',
        'department_name',
        'signed_image_url'
    ];

    /**
     * function for get full name of doctor
     *
     * @return string
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * function for get department name by get relation with department
     *
     * @return string
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getDepartmentNameAttribute()
    {
        return $this->department->name;
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
     * function for get realtionshi with department
     *
     * @return void
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
