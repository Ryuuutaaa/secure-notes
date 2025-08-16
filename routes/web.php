<?php

use App\Http\Controllers\NoteController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::middleware(['auth'])->group(function () {
    Route::resource('notes', NoteController::class)
        ->withoutMiddleware([VerifyCsrfToken::class]); // <- CSRF dimatikan khusus resource notes
});

require __DIR__ . '/auth.php';
