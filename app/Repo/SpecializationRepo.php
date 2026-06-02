<?php

namespace App\Repo;

use App\Models\Specialization;
use Exception;

class SpecializationRepo
{

    public function store($data)
    {
        $specialization = Specialization::create($data);
        return $specialization;
    }

    public function update($data, int $updateID)
    {
        try {
            $specialization = Specialization::findOrFail($updateID);
            $specialization->update($data);
            return $specialization;
        } catch (Exception $e) {
            throw new Exception("the specialization is not found");
        }
    }

    public function getAllSpecializationsAndDoctorCount()
    {
        $specializations = Specialization::withCount('doctors')->get();;
        return $specializations;
    }

    public function getSpecializationByID(int $specializationID)
    {
        try {
            $specialization = Specialization::withCount('doctors')->findOrFail($specializationID);
            return $specialization;
        } catch (Exception $e) {
            throw new Exception("the specialization is not found");
        }
    }

    public function delete(int $specializationID)
    {
        try {
            $specialization = Specialization::findOrFail($specializationID);
            $specialization->delete();
        } catch (Exception $e) {
            throw new Exception("the specialization is not found");
        }
    }
}
