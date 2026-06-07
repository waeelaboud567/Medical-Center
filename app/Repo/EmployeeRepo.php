<?php

namespace App\Repo;

use App\Models\Employee;
use Exception;

class EmployeeRepo
{

    public function store($data): Employee
    {
        $employee = Employee::create($data);
        return $employee;
    }
    public function update($newData, int $employee_id): Employee
    {
        try {
            $employee = Employee::findOrFail($employee_id);
            $employee->update($newData);
            return $employee;
        } catch (Exception $e) {
            throw new Exception("employee is not found");
        }
    }
    public function getAllEmployees()
    {
        $employees = Employee::with('person')->get();
        return $employees;
    }

    public function destroy(int $employee_id)
    {
        try {
            $employee = Employee::findOrFail($employee_id);
            $employee->delete();
        } catch (Exception $e) {
            throw new Exception("employee is not found");
        }
    }

    public function restore(int $employee_id)
    {
        $employee=Employee::withTrashed()->findOrFail($employee_id);
        $employee->restore();
        $employee=$employee->load('person.user');
        return $employee;
    }
}
