<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix('tags')->middleware(['auth:api'])->group(function () {
    Route::get('/', [TagController::class, 'get']);
    Route::middleware(['scopes:admin'])->group(function () {
        Route::post('/', [TagController::class, 'store']);
        Route::put('/{id}', [TagController::class, 'update']);
        Route::delete('/{id}', [TagController::class, 'delete']);
    });
});
