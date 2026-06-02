<?php

namespace App\Services;

use App\Repo\SpecializationRepo;

class SpecializationServices
{
    protected SpecializationRepo $specializationRepo;
    public function __construct(SpecializationRepo $specializationRepo)
    {
        $this->specializationRepo = $specializationRepo;
    }

    public function store($data)
    {
        $specialization = $this->specializationRepo->store($data);
        return $specialization;
    }

    public function update($data, int $updateID)
    {
        $newData = array_filter($data);
        $specialization = $this->specializationRepo->update($newData, $updateID);
        return $specialization;
    }

    public function getAllSpecializationsAndDoctorCount()
    {
        $specializations = $this->specializationRepo->getAllSpecializationsAndDoctorCount();
        return $specializations;
    }

    public function getSpecializationByID(int $specializationID)
    {
        $specialization = $this->specializationRepo->getSpecializationByID($specializationID);
        return $specialization;
    }

    public function delete(int $specializationID)
    {
        $this->specializationRepo->delete($specializationID);
    }
}
