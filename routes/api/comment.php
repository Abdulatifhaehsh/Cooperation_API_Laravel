<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::prefix('comments')->middleware(['auth:api'])->group(function () {
    Route::post('', [CommentController::class, 'storeComment']);
    Route::post('/reply', [CommentController::class, 'storeReply']);
});
