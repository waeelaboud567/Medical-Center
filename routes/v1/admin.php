<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\NurseController;
use App\Http\Controllers\Admin\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('v1')->group(function () {

    Route::prefix('users')->group(function () {

        Route::post('', [UserController::class, 'store']);

        Route::get('', [UserController::class, 'index']);

        Route::post('/{id}/role', [UserController::class, 'changeRole']);

        Route::post('/{id}/status', [UserController::class, 'changeStatus']);

        Route::put('/{id}', [UserController::class, 'update']);

        Route::get('/filter', [UserController::class, 'filterUser']);

        Route::get('/{id}', [UserController::class, 'show']);

        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
    Route::prefix('employees')->group(function () {

        Route::post('', [EmployeeController::class, 'store']);

        Route::put('/{id}', [EmployeeController::class, 'update']);

        Route::get('', [EmployeeController::class, 'index']);

        Route::delete('/{id}', [EmployeeController::class, 'destroy']);

        Route::patch('/{id}/restore', [EmployeeController::class, 'restore']);

        Route::get('/trashed', [EmployeeController::class, 'trashed']);

        Route::patch('/{id}/status',[EmployeeController::class,'changeEmploymentStatus']);

    });
    Route::prefix('doctors')->group(function () {

        Route::post('', [DoctorController::class, 'store']);

        Route::get('/{id}', [DoctorController::class, 'show']);

        Route::get('/', [DoctorController::class, 'index']);

        Route::patch('/{id}', [DoctorController::class, 'update']);
    });
    Route::prefix('specializations')->group(function () {

        Route::post('', [SpecializationController::class, 'store']);

        Route::put('/{id}', [SpecializationController::class, 'update']);

        Route::get('', [SpecializationController::class, 'index']);

        Route::get('/{id}', [SpecializationController::class, 'show']);

        Route::delete('/{id}', [SpecializationController::class, 'destroy']);
    });
    Route::prefix('nurses')->group(function () {

        Route::post('', [NurseController::class, 'store']);

        Route::put('/{id}', [NurseController::class, 'update']);

        Route::get('/{id}', [NurseController::class, 'show']);

        Route::get('', [NurseController::class, 'index']);

        Route::delete('/{id}', [NurseController::class, 'destroy']);

        Route::get('', [NurseController::class, 'index']);
    });
    Route::prefix('departments')->group(function () {

        Route::post('', [DepartmentController::class, 'store']);

        Route::put('/{id}', [DepartmentController::class, 'update']);

        Route::get('', [DepartmentController::class, 'index']);

        Route::get('/{id}', [DepartmentController::class, 'show']);

        Route::delete('/{id}', [DepartmentController::class, 'destroy']);

        Route::patch('/{id}/restore', [DepartmentController::class, 'restore']);

    });
});
