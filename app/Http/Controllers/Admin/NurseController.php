<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNurseRequest;
use App\Http\Requests\UpdateNurseRequest;
use App\Http\Resources\NurseResource;
use App\Services\NurseService;

class NurseController extends Controller
{
    protected NurseService $nurseService;

    public function __construct(NurseService $nurseService)
    {
        $this->nurseService = $nurseService;
    }

    public function store(StoreNurseRequest $request)
    {
        $validation = $request->validated();

        $nurse = $this->nurseService->store($validation);
        return response()->json([
            'message' => "Add Nurse Successfully",
            'nurse' => new NurseResource($nurse)
        ], 201);
    }

    public function update(UpdateNurseRequest $request, int $nurse_id)
    {
        $validation = $request->validated();
        $nurse = $this->nurseService->update($validation, $nurse_id);
        return response()->json([
            'message' => "update Nurse Successfully",
            'nurse' => new NurseResource($nurse)
        ], 200);
    }

    public function show(int $nurse_id)
    {
        $nurse = $this->nurseService->show($nurse_id);
        return response()->json([
            'nurse' => new NurseResource($nurse)
        ], 200);
    }

    public function index()
    {
        $nurses = $this->nurseService->index();
        return response()->json([
            'nurse' => NurseResource::collection($nurses)
        ], 200);
    }

    public function destroy(int $nurse_id)
    {
        $this->nurseService->destroy($nurse_id);
        return response()->json([
            'message' => 'Delete Nurse Successfully',
        ], 204);
    }
}
