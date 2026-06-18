<?php

namespace App\Services;

use App\Repo\DepartmentRepo;

class DepartmentService {

protected DepartmentRepo $departmentRepo;

public function __construct(DepartmentRepo $departmentRepo)
{
     $this->departmentRepo=$departmentRepo;
}

public function store($data)
{
    $department=$this->departmentRepo->store($data);
    return $department;
}

public function update($data,int $dept_id)
{
    $newData=array_filter($data);
    $department=$this->departmentRepo->update($newData,$dept_id);
    return $department;
}

public function getAllDepartments()
{
    $deparments=$this->departmentRepo->getAllDepartments();
    return $deparments;
}
public function getDepartmentByID(int $dept_id)
{
    $deparment=$this->departmentRepo->getDepartmentByID($dept_id);
    return $deparment;
}

public function destroy(int $dept_id)
{
    $this->departmentRepo->destroy($dept_id);

}

public function restore(int $department_id)
    {
        $department=$this->departmentRepo->restore($department_id);
        return $department;
    }
    
}
