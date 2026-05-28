<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes , HasFactory;




    public function person()
    {
        return $this->belongsTo(Person::class);
    }

     public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}
