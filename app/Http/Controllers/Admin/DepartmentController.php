<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function store(StoreDepartmentRequest $request)
    {
        $validation = $request->validated();
        $department = $this->departmentService->store($validation);
        return response()->json([
            'message' => 'Added Department Successfully',
            'department' => new DepartmentResource($department)
        ], 201);
    }

    public function update(UpdateDepartmentRequest $request, int $dept_id)
    {
        $validation = $request->validated();
        $department = $this->departmentService->update($validation, $dept_id);
        return response()->json([
            'message' => 'Updated Department Successfully',
            'department' => new DepartmentResource($department)
        ], 200);
    }

    public function index()
    {
        $departments = $this->departmentService->getAllDepartments();
        return response()->json(['$departments' => DepartmentResource::collection($departments)], 200);
    }

    public function show(int $dept_id)
    {
        $department = $this->departmentService->getDepartmentByID($dept_id);
        return response()->json(['$department' =>new DepartmentResource($department)], 200);
    }

    public function destroy(int $dept_id)
    {
        $this->departmentService->destroy($dept_id);
        return response()->noContent();
    }

    public function restore(int $dept_id)
    {
        $department = $this->departmentService->restore($dept_id);
        return response()->json([
            'message' => 'The department was successfully recovered',
            'department' => new DepartmentResource($department),
            200
        ]);
    }

    

}
