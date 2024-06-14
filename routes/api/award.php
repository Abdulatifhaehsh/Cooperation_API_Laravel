<?php

use App\Http\Controllers\AwardController;
use Illuminate\Support\Facades\Route;

Route::prefix('awards')->middleware(['auth:api'])->group(function () {
    Route::get('/', [AwardController::class, 'get']);
    Route::middleware(['scopes:admin'])->group(function () {
        Route::post('/', [AwardController::class, 'store']);
        Route::put('/{id}', [AwardController::class, 'update']);
        Route::delete('/{id}', [AwardController::class, 'delete']);
    });
});
