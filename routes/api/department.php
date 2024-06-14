<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('departments')->middleware(['auth:api'])->group(function () {
    Route::get('/', [DepartmentController::class, 'get']);
    Route::middleware(['scopes:admin'])->group(function () {
        Route::post('/', [DepartmentController::class, 'store']);
        Route::put('/{id}', [DepartmentController::class, 'update']);
        Route::delete('/{id}', [DepartmentController::class, 'delete']);
    });
});
