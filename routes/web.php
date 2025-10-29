<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('home');
    Route::resource('tasks', TaskController::class)->except(['show']);
});
