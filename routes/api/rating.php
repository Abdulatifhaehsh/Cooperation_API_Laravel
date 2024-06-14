<?php

use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::prefix('ratings')->middleware(['auth:api'])->group(function () {
    Route::post('', [RatingController::class, 'storeRating']);
});
