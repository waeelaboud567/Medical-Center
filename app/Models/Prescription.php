<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function medical_record()
    {
        return $this->belongsTo(Medical_Record::class);
    }
}
