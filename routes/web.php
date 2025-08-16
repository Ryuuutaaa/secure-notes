<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

// Homepage
Route::get('/', fn() => redirect('/notes'));

// Dashboard redirect ke notes
Route::get('/dashboard', fn() => redirect('/notes'))
    ->middleware(['auth'])
    ->name('dashboard');

// VULNERABLE Routes (CSRF disabled)
Route::middleware(['auth'])->group(function () {
    Route::resource('notes', NoteController::class)
        ->withoutMiddleware([VerifyCsrfToken::class]); // BAHAYA: CSRF OFF
});

require __DIR__ . '/auth.php';
