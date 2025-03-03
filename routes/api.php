<?php

use App\Models\User;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpaceController;

// Noves rutes
Route::bind('space', function ($value) {
    return is_numeric($value)
        ? Space::findOrFail($value) // Cerca pel camp 'id'
        : Space::where('regNumber', $value)->firstOrFail(); // Cerca pel camp 'regNumber'
});
Route::bind('user', function ($value) {
    return is_numeric($value)
        ? User::findOrFail($value) // Cerca pel camp 'id'
        : User::where('email', $value)->firstOrFail(); // Cerca pel camp 'email'
});

Route::get('/spaces', [SpaceController::class, 'index']);
Route::get('/spaces/{space}', [SpaceController::class, 'show']);

// Obtener comentarios de un usuario específico
Route::get('/users/{userId}/comments', [CommentController::class, 'index']);

Route::get('/comments', [CommentController::class, 'index']);

// Obtener comentarios de un espacio específico
Route::get('/spaces/{id}/comments', [CommentController::class, 'getCommentsBySpaceId']);
Route::get('/users/{userId}/comments', [CommentController::class, 'getCommentsByUser']);



Route::post('/spaces/{space}/comments', [CommentController::class, 'store']);
Route::get('/spaces/{space}/comments', [CommentController::class, 'getCommentsBySpace']);



// Rutes sense autenticació
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // ✅ Solo aquí

    Route::apiresource('/space', SpaceController::class)->only(['index', 'show', 'store']);
    Route::apiresource('/user', SpaceController::class)->only(['show', 'update', 'destroy']);
});
