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

    /**
     * function for set appointment number or generate unique
     *
     * @return object
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function setAppointmentNumberAttribute()
    {
        $this->attributes['appointment_number'] = "#APMT-" . Carbon::now()->format('ymDHis');
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
