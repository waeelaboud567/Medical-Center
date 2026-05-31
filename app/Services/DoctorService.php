<?php

namespace App\Services;

use App\Repo\DoctorRepo;

class DoctorService
{
    protected DoctorRepo $doctorRepo;

    public function __construct(DoctorRepo $doctorRepo) {
        $this->doctorRepo=$doctorRepo;
    }

    public function store($data)
    {
        $doctor=$this->doctorRepo->store($data);
        return $doctor;
    }

    public function getDoctorByID(int $doctor_id)
    {
           $doctor=$this->doctorRepo->getDoctorByID($doctor_id);
           return $doctor;
    }

    public function getAllDoctors()
    {
        $doctors=$this->doctorRepo->getAllDoctors();
        return $doctors;
    }

    public function update($data,int $doctor_id)
    {      $newData=array_filter($data);
           $doctor=$this->doctorRepo->update($newData,$doctor_id);
           return $doctor;
    }
}
