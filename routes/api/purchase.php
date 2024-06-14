<?php

use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::prefix('purchases')->middleware(['auth:api'])->group(function () {
    Route::post('/', [PurchaseController::class, 'store']);
    Route::middleware(['scopes:admin'])->group(function () {
        Route::get('/', [PurchaseController::class, 'get']);
    });
});
