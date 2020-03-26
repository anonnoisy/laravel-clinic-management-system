<?php

namespace App\Models\Bed;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $fillable = [
        'bed_number',
        'bed_type_id',
        'total_bed',
        'bed_currently',
        'bed_usage',
        'description'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Bed\Type', 'bed_type_id');
    }

}
