<?php

use App\Http\Controllers\newNoteController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLog;
use App\Http\Middleware\CheckUserNotLog;

Route::middleware(CheckUserNotLog::class)->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
});

Route::middleware(CheckLog::class)->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('newNote', [NewNoteController::class, 'newNote'])->name('newNote');
    Route::get('/editNote/{id}', [NoteController::class, 'editNote'])->name('editNote');
    Route::get('/deleteNote/{id}', [NoteController::class, 'deleteNote'])->name('deleteNote');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
