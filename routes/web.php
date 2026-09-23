<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// Estrutura 100% Laravel: rotas web tradicionais, sem API, sem SPA.
// Autenticação via sessão (Auth facade); views em resources/views (Blade).

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registrar', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registrar', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [MovieController::class, 'index'])->name('dashboard');
    Route::get('/filmes/novo', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/filmes', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/filmes/{movie}/editar', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/filmes/{movie}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/filmes/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
});
