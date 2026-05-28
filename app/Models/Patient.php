<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function person()
    {
        return $this->belongsTo(Person::class);
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
