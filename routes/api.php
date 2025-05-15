<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisteredWordController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\LogController;

Route::post('/register', [AuthController::class, 'signIn']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('game')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    
    Route::get('/words', [WordController::class, 'show']);
    Route::post('/answer', [WordController::class, 'answer']);
    Route::get('/logs', [LogController::class, 'index']);

    Route::get('/history', [RegisteredWordController::class, 'index']);
    Route::get('/progress', [RegisteredWordController::class, 'progress']);
});