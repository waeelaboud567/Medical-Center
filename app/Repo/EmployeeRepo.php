<?php

namespace App\Repo;

use App\Enums\EmployeeStatus;
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
        $employees = Employee::with('person.user')->get();
        return $employees;
    }

    public function destroy(int $employee_id)
    {
        try {
            $employee = Employee::findOrFail($employee_id);
            $employee->changeEmploymentStatus('terminated');
            $employee->delete();
        } catch (Exception $e) {
            throw new Exception("employee is not found");
        }
    }

    public function restore(int $employee_id)
    {
        $employee = Employee::withTrashed()->findOrFail($employee_id);
        $employee->restore();
        $employee->changeEmploymentStatus('active');
        $employee = $employee->load('person.user');
        return $employee;
    }

    public function getAllEmployeesTrashed()
    {
        $employees = Employee::onlyTrashed('person.user')->get();
        return $employees;
    }

    public function getEmployeeByID(int $employee_id) :Employee
    {
        $employee=Employee::findOrFail($employee_id);
        return $employee;

    }
}
