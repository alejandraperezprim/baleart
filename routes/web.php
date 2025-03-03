<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backoffice\SpaceController;
use App\Http\Controllers\Backoffice\CommentController;
use App\Http\Controllers\Backoffice\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // Gestión de Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->group(function () {
        Route::get('/spaces', [SpaceController::class, 'index'])->name('spaces.index');
        Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
        Route::resource('users', UserController::class)->except(['show', 'create', 'store']);
        Route::get('/users/{user}/comments', [UserController::class, 'comments'])->name('users.comments');
        Route::put('/comments/{comment}/toggle-status', [CommentController::class, 'toggleStatus'])->name('comments.toggleStatus');
        Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
        Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
        Route::resource('spaces', SpaceController::class)->except(['show']);       
    });

   
});

require __DIR__.'/auth.php';
