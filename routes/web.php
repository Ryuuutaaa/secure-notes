<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', fn() => redirect('/notes'));

// Dashboard redirect ke notes  
Route::get('/dashboard', fn() => redirect('/notes'))
    ->middleware(['auth'])
    ->name('dashboard');

// SECURE Routes (CSRF enabled)
Route::middleware(['auth'])->group(function () {
    Route::resource('notes', NoteController::class); // CSRF ON (secure)
});

require __DIR__ . '/auth.php';
