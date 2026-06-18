<?php

namespace App\Repo;

use App\Models\Department;
use Exception;

class DepartmentRepo
{

    public function store($data)
    {
        $department = Department::create($data);
        $department = $department->loadCount(['nurses', 'doctors']);
        return $department;
    }

    public function update($data, int $dept_id)
    {
        $department = Department::withCount(['doctors', 'nurses'])->findOrFail($dept_id);
        $department->update($data);
        return $department;
    }

    public function getAllDepartments()
    {
        $departments = Department::withCount(['doctors', 'nurses'])->get();
        return $departments;
    }

    public function getDepartmentByID($dept_id)
    {
        $department = Department::withCount(['doctors', 'nurses'])->findOrFail($dept_id);
        return $department;
    }

    public function destroy($dept_id)
    {
        try {
            $department = Department::findOrFail($dept_id);
            $department->delete();
        } catch (Exception $e) {
            throw new Exception("the department is not found");
        }
    }

    public function restore(int $dept_id)
    {
        $department = Department::withTrashed()->findOrFail($dept_id);
        $department->restore();

        return $department;
    }
}
