<?php

namespace App\Models;

use App\Enums\EmployeeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = [];

    protected $casts = [
        'employment_status' => EmployeeStatus::class,
    ];


    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function nurse()
    {
        return $this->hasOne(Nurse::class);
    }


    public function changeEmploymentStatus(string $status): void
    {
        $employmentStatus = EmployeeStatus::tryFrom($status);

        if (!$employmentStatus) {
            throw new \InvalidArgumentException('Invalid employment status');
        }

        $this->employment_status = $employmentStatus;
        $this->save();
    }
}
