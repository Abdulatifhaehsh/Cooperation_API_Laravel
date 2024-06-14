<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('items')->middleware(['auth:api'])->group(function () {
    Route::get('/', [ItemController::class, 'get']);
    Route::middleware(['scopes:admin'])->group(function () {
        Route::post('/', [ItemController::class, 'store']);
        Route::put('/{id}', [ItemController::class, 'update']);
        Route::delete('/{id}', [ItemController::class, 'delete']);
    });
});
