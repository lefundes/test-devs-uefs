<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Users CRUD
    Route::apiResource('users', UserController::class);
    
    // Posts CRUD
    Route::apiResource('posts', PostController::class);
    Route::get('posts/published', [PostController::class, 'published']);
    
    // Tags CRUD
    Route::apiResource('tags', TagController::class);
});
