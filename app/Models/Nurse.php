<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
