<?php

namespace App\Repo;

use App\Models\Nurse;

class NurseRepo
{

    public function store($data)
    {
        $nurse = Nurse::create($data);
        $nurse = $nurse->load('employee.person.user');
        return $nurse;
    }

    public function update($newData, int $nurse_id)
    {
        $nurse = Nurse::findOrFail($nurse_id);
        $nurse->update($newData);
        $nurse = $nurse->load('employee.person.user');

        return $nurse;
    }

    public function show(int $nurse_id)
    {
        $nurse = Nurse::findOrFail($nurse_id);
        $nurse = $nurse->load('employee.person.user');
        return $nurse;
    }

    public function index()
    {
        $nurses = Nurse::with('employee.person.user')->get();
        return $nurses;
    }

    public function destroy($nurse_id)
    {
        $nurse = Nurse::findOrFail($nurse_id);
        $nurse->delete();
        
    }
}
