<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');