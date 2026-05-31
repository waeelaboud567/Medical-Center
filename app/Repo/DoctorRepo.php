<?php

namespace App\Repo;

use App\Models\Doctor;
use Exception;

class DoctorRepo
{

    public function store($data)
    {
        $doctor = Doctor::create($data);
        $doctor->load('employee.person.user','specialization');
        return $doctor;
    }

    public function getDoctorByID(int $doctor_id)
    {
        try{
        $doctor=Doctor::with('employee.person.user','specialization')->findOrFail($doctor_id);
        }
        catch(Exception $e)
        {
            throw new Exception("the doctor is not found");
        }
        return $doctor;
    }

    public function getAllDoctors()
    {
        try{
        $doctors=Doctor::with('employee.person.user','specialization')->get();
        }
        catch(Exception $e)
        {
            throw new Exception("not found any doctors");
        }
        return $doctors;
    }

    public function update($data,int $doctor_id)
    {
        $doctor=Doctor::findOrFail($doctor_id);
        $doctor->update($data);

        return $doctor;

    }
}
