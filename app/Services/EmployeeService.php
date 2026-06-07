<?php

namespace App\Services;

use App\Models\Employee;
use App\Repo\EmployeeRepo;

class EmployeeService
{

    protected EmployeeRepo $employeeRepo;

    public function __construct(EmployeeRepo $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    public function store($data): Employee
    {
        $employee = $this->employeeRepo->store($data);
        $user = $employee->person->user;
        $user->assignRole(['employee']);
        return $employee;
    }
    public function update($data, int $employee_id): Employee
    {
        $employee = $this->employeeRepo->update(array_filter($data), $employee_id);
        return $employee;
    }
    public function getAllEmployees()
    {
        $employees = $this->employeeRepo->getAllEmployees();
        return $employees;
    }

    public function destroy(int $employee_id)
    {
        $this->employeeRepo->destroy($employee_id);
    }

    public function restore(int $employee_id)
    {
        $employee=$this->employeeRepo->restore($employee_id);
        return $employee;
    }
}
