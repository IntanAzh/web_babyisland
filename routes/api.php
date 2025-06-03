<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Categories
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

// Products
Route::apiResource('products', ProductController::class)->only(['index', 'show']);

// Reviews
Route::get('/products/{product}/reviews', [ReviewController::class, 'getProductReviews']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // User profile
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/user/profile', [AuthController::class, 'updateProfile']);
    
    // Orders
    Route::apiResource('orders', OrderController::class);
    
    // Transactions
    Route::apiResource('transactions', TransactionController::class)->except(['destroy']);
    Route::post('/transactions/{transaction}/upload-proof', [TransactionController::class, 'uploadPaymentProof']);
    
    // Reviews
    Route::apiResource('reviews', ReviewController::class)->except(['index', 'show']);
});