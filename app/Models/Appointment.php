<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    Public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    Public function patient(){
        return $this->belongsTo(Patient::class);
    }
     Public function medical_record(){
        return $this->hasOne(Medical_Record::class);
    }

    public function bill()
    {
        return $this->hasOne(Bill::class);
    }
}
