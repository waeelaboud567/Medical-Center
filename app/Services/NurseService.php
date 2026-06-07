<?php

namespace App\Services;

use App\Repo\NurseRepo;

class NurseService
{

    protected NurseRepo $nurseRepo;

    public function __construct(NurseRepo $nurseRepo)
    {
        $this->nurseRepo = $nurseRepo;
    }

    public function store($data)
    {
        $nurse = $this->nurseRepo->store($data);
        return $nurse;
    }

    public function update($data, int $nurse_id)
    {
        $newData = array_filter($data);
        $nurse = $this->nurseRepo->update($newData, $nurse_id);
        return $nurse;
    }

    public function show($nurse_id)
    {
        $nurse = $this->nurseRepo->show($nurse_id);
        return $nurse;
    }

    public function index()
    {
        $nurses = $this->nurseRepo->index();
        return $nurses;
    }

    public function destroy($nurse_id)
    {
        $nurse = $this->nurseRepo->destroy($nurse_id);
    }
}
