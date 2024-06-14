<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::prefix('activities')->middleware(['auth:api'])->group(function () {
    Route::get('/', [ActivityController::class, 'get']);
    Route::get('/history', [ActivityController::class, 'getHistory']);
    Route::post('/', [ActivityController::class, 'store']);
    Route::put('/{id}', [ActivityController::class, 'update']);
    Route::delete('/{id}', [ActivityController::class, 'delete']);
    // Route::middleware(['scopes:admin'])->group(function () {
    // });
});
