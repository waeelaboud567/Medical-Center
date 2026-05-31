<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Services\DoctorService;


class DoctorController extends Controller
{
    protected DoctorService $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function store(StoreDoctorRequest $request)
    {
        $validation = $request->validated();
        $doctor = $this->doctorService->store($validation);
        return response()->json([
            'message' => 'Add doctor successfully',
            'doctor' => new DoctorResource($doctor)
        ], 200);
    }

    public function show(int $doctor_id)
    {
        $doctor=$this->doctorService->getDoctorByID($doctor_id);
        return response()->json([
            'doctor'=>  new DoctorResource($doctor)
        ]);
    }

    public function index()
    {
        $doctors=$this->doctorService->getAllDoctors();
        return response()->json([
            'doctor'=> DoctorResource::collection($doctors)
        ]);
    }

    public function update(UpdateDoctorRequest $request,int $doctor_id)
    {
        $validation=$request->validated();
        $doctor=$this->doctorService->update($validation,$doctor_id);
        return response()->json([
            'doctor'=>  new DoctorResource($doctor)
        ]);
    }
}
