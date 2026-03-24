<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AdController;

Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->get('/v1/user', function (Request $request) {
    return response()->json([
        'success' => true,
        'message' => 'User fetched successfully.',
        'data' => [
            'user' => $request->user(),
        ]
    ]);
});

Route::prefix('v1/ads')->group(function () {
    Route::get('/', [AdController::class, 'index']); // Open to all or based on role
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [AdController::class, 'store']);
        Route::put('/{id}', [AdController::class, 'update']);
        Route::post('/{id}/pause', [AdController::class, 'pause']);
        Route::post('/{id}/start', [AdController::class, 'start']);
        Route::post('/{id}/complete', [AdController::class, 'complete']);
    });
});
