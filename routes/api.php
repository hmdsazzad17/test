<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AdController;
use App\Http\Controllers\API\WithdrawalController;
use App\Http\Controllers\API\DepositController;

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

Route::middleware('auth:sanctum')->prefix('v1/withdrawals')->group(function () {
    Route::get('/', [WithdrawalController::class, 'index']);
    Route::post('/', [WithdrawalController::class, 'store']);
});

Route::middleware('auth:sanctum')->prefix('v1/deposits')->group(function () {
    Route::get('/', [DepositController::class, 'index']);
    Route::post('/', [DepositController::class, 'store']);
});
Route::post('v1/deposits/webhook', [DepositController::class, 'webhook']);

// Admin Routes
Route::middleware(['auth:sanctum', 'admin'])->prefix('v1/admin')->group(function () {
    Route::get('/users', [\App\Http\Controllers\API\Admin\UserController::class, 'index']);
    Route::post('/users/{id}/ban', [\App\Http\Controllers\API\Admin\UserController::class, 'ban']);

    Route::get('/ads', [\App\Http\Controllers\API\Admin\AdController::class, 'index']);
    Route::put('/ads/{id}/status', [\App\Http\Controllers\API\Admin\AdController::class, 'updateStatus']);

    Route::get('/withdrawals', [\App\Http\Controllers\API\Admin\WithdrawalController::class, 'index']);
    Route::put('/withdrawals/{id}/process', [\App\Http\Controllers\API\Admin\WithdrawalController::class, 'process']);
});
