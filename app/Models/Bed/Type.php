<?php

namespace App\Models\Bed;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'bed_types';
    protected $fillable = [
        'name',
        'description'
    ];
}
