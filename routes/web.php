<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::middleware(['auth'])->group(function () {
    Route::resource('notes', NoteController::class);
});

require __DIR__ . '/auth.php';
