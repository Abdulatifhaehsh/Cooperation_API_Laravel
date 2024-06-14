<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::post('/signIn', [UserController::class, 'signIn']);
    Route::put('/', [UserController::class, 'updateUser'])->middleware('auth:api');
    Route::get('/myUser', [UserController::class, 'myUser'])->middleware('auth:api');
    Route::get('/', [UserController::class, 'getUsers'])->middleware('auth:api');
    Route::middleware(['auth:api', 'scopes:admin'])->group(function () {
        Route::post('/', [UserController::class, 'createUser']);
        Route::delete('/{id}', [UserController::class, 'deleteUser']);
    });
});
