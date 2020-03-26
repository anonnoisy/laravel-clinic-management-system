<?php

namespace App\Models\Bed;

use App\Models\User\Patient;
use Illuminate\Database\Eloquent\Model;

class BedAllotment extends Model
{
    protected $fillable = [
        'bed_id',
        'patient_id',
        'allotment_time',
        'discharge_time'
    ];

    /**
     * function for get allotment time formatted
     *
     * @return string
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getAllotmentTimeFormattedAttribute()
    {
        return date('m/d/Y', strtotime($this->allotment_time));
    }

    /**
     * function for get discharge time formatted
     *
     * @return string
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getDischargeTimeFormattedAttribute()
    {
        return date('m/d/Y', strtotime($this->discharge_time));
    }

    /**
     * function for set allotment time formatted
     *
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function setAllotmentTimeAttribute($value)
    {
        $this->attributes['allotment_time'] = date('Y-m-d H:i:s', strtotime($value));
    }

    /**
     * function for set discharge time formatted
     *
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function setDischargeTimeAttribute($value)
    {
        $this->attributes['discharge_time'] = date('Y-m-d H:i:s', strtotime($value));
    }

    /**
     * function for set realtionsehip with bed
     *
     * @return object
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    /**
     * function for set realtionsehip with patient
     *
     * @return object
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
