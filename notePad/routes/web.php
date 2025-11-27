<?php

use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\NewNoteController;
use App\Http\Controllers\UpdateNoteController;
use App\Http\Controllers\DeleteNoteController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLog;
use App\Http\Middleware\CheckUserNotLog;

Route::post('register', [CreateUserController::class, 'createUser'])
    ->name('register')
    ->withoutMiddleware(VerifyCsrfToken::class);

Route::middleware(CheckUserNotLog::class)->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
});

Route::middleware(CheckLog::class)->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('newNote', [NewNoteController::class, 'newNote'])->name('new');
    Route::post('newNoteSubmit', [NewNoteController::class, 'newNoteSubmit'])->name('newNoteSubmit');
    Route::get('/editNote/{id}', [UpdateNoteController::class, 'updateNote'])->name('edit');
    Route::post('/updateNoteSubmit', [UpdateNoteController::class, 'updateNoteSubmit'])->name('editNoteSubmit');
    Route::get('/deleteNote/{id}', [DeleteNoteController::class, 'deleteNote'])->name('delete');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
