<?php

namespace App\Models\Medicine;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'medicine_categories';

    protected $fillable = [
        'name',
        'description',
    ];

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'category_medicine', 'medicine_id', 'medicine_category_id')->withTimestamps();
    }
}
