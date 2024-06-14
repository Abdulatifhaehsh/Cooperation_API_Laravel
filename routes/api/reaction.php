<?php

use App\Http\Controllers\ReactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('reactions')->middleware(['auth:api'])->group(function () {
    Route::post('/post', [ReactionController::class, 'storeReactionForPost']);
    Route::post('/comment', [ReactionController::class, 'storeReactionForComment']);
});
