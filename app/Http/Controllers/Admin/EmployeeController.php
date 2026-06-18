<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmployeeStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStatusRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\UserResource;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function store(StoreEmployeeRequest $request)
    {
        $validation = $request->validated();
        $employee = $this->employeeService->store($validation);
        return response()->json([
            'message' => 'He was successfully hired as an employee ',
            'employee' => new EmployeeResource($employee),
            'user' => new UserResource($employee->person?->user)
        ], 201);
    }

    public function update(UpdateEmployeeRequest $request, int $employee_id)
    {
        $validation = $request->validated();
        $employee = $this->employeeService->update($validation, $employee_id);
        return response()->json([
            'message' => 'update employee successfully ',
            'employee' => new EmployeeResource($employee),
            'user' => new UserResource($employee->person?->user)
        ], 200);
    }
    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        return response()->json([
            "employees" => EmployeeResource::collection($employees),
            200
        ]);
    }

    public function destroy(int $employee_id)
    {
        $this->employeeService->destroy($employee_id);
        return response()->noContent();
    }

    public function restore(int $employee_id)
    {
        $employee = $this->employeeService->restore($employee_id);
        return response()->json([
            'message' => 'The employee was successfully recovered',
            'employee' => new EmployeeResource($employee),
            200
        ]);
    }

    public function trashed()
    {
        $employees = $this->employeeService->getAllEmployeesTrashed();
        return response()->json([
            "employees" => EmployeeResource::collection($employees),
            200
        ]);
    }

    public function changeEmploymentStatus(EmployeeStatusRequest $request, int $employee_id)
    {
        $validation = $request->validated();
        $this->employeeService->changeEmploymentStatus($validation, $employee_id);
        return response()->json(["message"=>"The employee's status has been changed to {$validation['employment_status']}"]
        ,200);
    }
}
