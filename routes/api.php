<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RegisteredWordsController;
use App\Http\Controllers\WordsController;

Route::post('/register', [AuthController::class, 'signIn']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('game')->group(function () {
    Route::get('/categories', [CategoriesController::class, 'index']);
    
    Route::get('/words', [WordsController::class, 'show']);
    Route::post('/answer', [WordsController::class, 'answer']);

    Route::get('/history', [RegisteredWordsController::class, 'index']);
    Route::get('/progress', [RegisteredWordsController::class, 'progress']);
});