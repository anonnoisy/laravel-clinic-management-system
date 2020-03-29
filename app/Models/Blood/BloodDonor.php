<?php

namespace App\Models\Blood;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BloodDonor extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'birth_date',
        'age',
        'sex',
        'blood_group',
        'last_donation_date',
    ];

    protected $appends = [
        'name',
        'last_donation_date_formatted',
        'birth_date_formatted'
    ];

    /**
     * function for get full name of donation person
     *
     * @return string
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * function for get birth date formatted Month Day Year
     *
     * @return string
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getLastDonationDateFormattedAttribute()
    {
        return Carbon::parse($this->last_donation_date)->format('m/d/Y');
    }

    /**
     * function for get birth date formatted Month Day Year
     *
     * @return string
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function getBirthDateFormattedAttribute()
    {
        return Carbon::parse($this->birth_date)->format('m/d/Y');
    }

    /**
     * function for set last donation date before transaction into DB
     *
     * @return datetime
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function setLastDonationDateAttribute($value)
    {
        $this->attributes['last_donation_date'] = date('Y-m-d H:i:s', strtotime($value));
    }

    /**
     * function for set birth date before transaction into DB
     *
     * @return datetime
     * @author Rifky Sulta Karisma A <batuhc105@gmail.com>
     */
    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = date('Y-m-d H:i:s', strtotime($value));
    }
}
