<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'signIn']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('game')->group(function () {
    Route::get('/word', [\App\Http\Controllers\GameController::class, 'word']);
    Route::post('/answer', [\App\Http\Controllers\GameController::class, 'answer']);
    Route::get('/history', [\App\Http\Controllers\GameController::class, 'history']);
    Route::get('/progress', [\App\Http\Controllers\GameController::class, 'progress']);
});
