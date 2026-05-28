<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes , HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}
