<?php

namespace App\Models\Department;

use Illuminate\Database\Eloquent\Model;

class DepartmentFacility extends Model
{
    protected $fillable = [
        'department_id',
        'title',
        'description'
    ];

    /**
     * function for get relationship with Department
     *
     * @return App\Models\Department\Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
