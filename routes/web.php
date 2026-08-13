<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;




# Route::get('/', fn () => view('welcome'));
Route::redirect('/', '/ideas');

Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index')->middleware('auth');
Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store')->middleware('auth');
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('ideas.show')->middleware('auth');
// Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit');
// Route::patch('/ideas/{idea}', [IdeaController::class, 'update'])->name('ideas.update');
Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy')->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');