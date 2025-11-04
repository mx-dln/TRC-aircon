<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ProgressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Clients
    Route::apiResource('clients', ClientController::class);
    
    // Progress
    Route::apiResource('clients.progress', ProgressController::class);
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Get current user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});