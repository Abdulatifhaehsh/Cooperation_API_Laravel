<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
//TODO:: Besher there is a changing here in accept post. Please notice that and delete this todo when reading that
Route::prefix('posts')->middleware(['auth:api'])->group(function () {
    Route::post('/', [PostController::class, 'store']);
    Route::get('/', [PostController::class, 'getPosts']);
    Route::put('/{id}/accept', [PostController::class, 'acceptPost'])->middleware('scopes:admin');
    Route::get('/forAdmin', [PostController::class, 'getPostsForAdmin'])->middleware('scopes:admin');
    Route::delete('/{id}', [PostController::class, 'delete'])->middleware('scopes:admin');
});
