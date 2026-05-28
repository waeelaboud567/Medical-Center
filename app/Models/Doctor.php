<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;




    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'doctor_department', 'doctor_id', 'deparments_id');
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function medical_records()
    {
        return $this->hasMany(Medical_Record::class);
    }


}
