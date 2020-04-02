<?php

namespace App\Models\Medicine;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name', 
        'price',
        'quantity',
        'manufacture_company',
        'description',
        'status'
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_medicine', 'medicine_id', 'medicine_category_id')->withTimestamps();
    }
}
