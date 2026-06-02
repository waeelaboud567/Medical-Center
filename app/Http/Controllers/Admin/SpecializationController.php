<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecializationRequest;
use App\Http\Requests\UpdateSpecializationRequest;
use App\Http\Resources\SpecializationResource;
use App\Services\SpecializationServices;

class SpecializationController extends Controller
{
    protected SpecializationServices $specializationServices;
    public function __construct(SpecializationServices $specializationServices)
    {
        $this->specializationServices = $specializationServices;
    }

    public function store(StoreSpecializationRequest $request)
    {
        $validation = $request->validated();
        $specialization = $this->specializationServices->store($validation);
        return response()->json([
            'message' => 'The specialization has been successfully added',
            'specialization' => new SpecializationResource($specialization),
            201
        ]);
    }

    public function update(UpdateSpecializationRequest $request, int $updateID)
    {
        $validation = $request->validated();
        $specialization = $this->specializationServices->update($validation, $updateID);
        return response()->json([
            'message' => 'The specialization has been successfully updated',
            'specialization' => new SpecializationResource($specialization),
            200
        ]);
    }

    public function index()
    {
        $specializations = $this->specializationServices->getAllSpecializationsAndDoctorCount();
        return response()->json([
            'specializations' => SpecializationResource::collection($specializations),
            200
        ]);
    }

    public function show(int $specializationID)
    {
        $specialization = $this->specializationServices->getSpecializationByID($specializationID);
        return response()->json([
            'specializations' => new SpecializationResource($specialization),
            200
        ]);
    }

    public function destroy(int $specializationID)
    {
        $this->specializationServices->delete($specializationID);
        return response()->json([
            'message' => 'The specialization has been successfully deleted'
        ]);
    }
}
