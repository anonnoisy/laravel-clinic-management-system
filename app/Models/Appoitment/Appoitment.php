<?php

namespace App\Models\Appoitment;

use App\Models\User\Doctor;
use App\Models\User\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Appoitment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_number',
        'time',
        'date',
        'primary_diagnoses',
        'secondary_diagnoses',
        'clinical_notes',
        'status',
    ];

    protected $appends = [
        'time_formatted',
        'date_formatted',
    ];

    /**
     * function for get appointment time formatted
     *
     * @return object
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getTimeFormattedAttribute()
    {
        return date('H:i A', strtotime($this->time));
    }

    /**
     * function for set appointment time
     *
     * @return object
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function setTimeAttribute($value)
    {
        $this->attributes['time'] = date('H:i:s', strtotime($value));
    }

    /**
     * function for get appointment date formatted
     *
     * @return object
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getDateFormattedAttribute()
    {
        return date('m/d/Y', strtotime($this->date));
    }

    /**
     * function for set appointment date
     *
     * @return object
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('Y-m-d H:i:s', strtotime($value));
    }

    /**
     * function for get realtionshi with Patient
     *
     * @return object
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * function for get realtionshi with User
     *
     * @return object
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
