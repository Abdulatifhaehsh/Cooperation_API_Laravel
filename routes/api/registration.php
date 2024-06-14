<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('registrations')->middleware(['auth:api'])->group(function () {
    Route::post('', [RegistrationController::class, 'storeOrDeleteRregistration']);
});
