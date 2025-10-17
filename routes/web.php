<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\TagController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/readme', [DashboardController::class, 'readme'])->name('readme');

// Users Routes
Route::resource('users', UserController::class);

// Posts Routes  
Route::resource('posts', PostController::class);

// Tags Routes
Route::resource('tags', TagController::class);