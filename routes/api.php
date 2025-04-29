<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;

Route::post('/register', [AuthController::class, 'signIn']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('game')->group(function () {
    Route::get('/word', [GameController::class, 'word']);
    Route::post('/answer', [GameController::class, 'answer']);
    Route::get('/history', [GameController::class, 'history']);
    Route::get('/progress', [GameController::class, 'progress']);
});
