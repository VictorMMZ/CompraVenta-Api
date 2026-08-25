<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth')->group(function () {
Route::apiResource('users', UserController::class);
Route::get('/categories', [CategoryController::class, 'index']);
Route::apiResource('purchases', PurchaseController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('sellers', SellerController::class);
Route::apiResource('sales', SaleController::class);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/logout', [AuthController::class, 'logout']);
});

