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
Route::get('/users/list', [UserController::class, 'index'])->name('web.users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('web.users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('web.users.store');

// ROTA ESPECÍFICA DEVE VIR ANTES DA ROTA COM PARÂMETRO
Route::get('/users/datatable', [UserController::class, 'datatable'])->name('web.users.datatable');

// Rotas com parâmetros DEVEM VIR DEPOIS das rotas específicas
Route::get('/users/{user}', [UserController::class, 'show'])->name('web.users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('web.users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('web.users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('web.users.destroy');