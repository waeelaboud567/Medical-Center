<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     use HasFactory;

    protected $fillable = [
        'department_name',
        'location',
    ];
    public function nurses()
    {
        return $this->hasMany(Nurse::class);
    }
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class,'doctor_department','department_id','doctor_id');
    }
}
