<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::prefix('v1/users')->group(function () {

        Route::post('', [UserController::class, 'store']);

        Route::get('', [UserController::class, 'index']);

        Route::post('/{id}/role', [UserController::class, 'changeRole']);

        Route::post('/{id}/status', [UserController::class, 'changeStatus']);

        Route::put('/{id}', [UserController::class, 'update']);

        Route::get('/filter', [UserController::class, 'filterUser']);

        Route::get('/{id}', [UserController::class, 'show']);

        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
    Route::prefix('v1/employees')->group(function () {

        Route::post('', [EmployeeController::class, 'store']);

        Route::put('/{id}', [EmployeeController::class, 'update']);

        Route::get('', [EmployeeController::class, 'index']);
    });
});
