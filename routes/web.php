<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResumoController;

// Rotas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Rotas para resumos
    Route::get('/resumo/criar', [ResumoController::class, 'create'])->name('resumo.create');
    Route::post('/api/generate-resume', [ResumoController::class, 'generateResume'])->name('resumo.generate');
    Route::get('/resumo/resultado/{id}', [ResumoController::class, 'show'])->name('resumo.show');
    Route::get('/resumos/historico', [ResumoController::class, 'historico'])->name('resumo.historico');
    Route::post('/api/resumo/save', [ResumoController::class, 'save'])->name('resumo.save');
});
