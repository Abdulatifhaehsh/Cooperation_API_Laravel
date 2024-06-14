<?php

use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix('statistics')->middleware(['auth:api', 'scopes:admin'])->group(function () {
    Route::get('/', [StatisticsController::class, 'statistics']);
});
