<?php

namespace App\Models\Department;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_url',
    ];

    protected $appends = [
        'signed_image_url'
    ];

    public function getSignedImageUrlAttribute()
    {
        if (!empty($this->image_url)) {
            return asset('storage' . $this->image_url);
        }
    }
}
