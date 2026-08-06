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
Route::get('/user', [UserController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::apiResource('purchases', PurchaseController::class);
Route::apiResource('products', ProductController::class);
  Route::apiResource('sellers', SellerController::class);

Route::apiResource('sales', SaleController::class);
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Route::get('/user', [AuthController::class, 'user']);

    Route::post('/users/register', [UserController::class, 'register']);



    // Route::apiResource('products', ProductController::class);

    // Route::apiResource('purchases', PurchaseController::class);

    // Route::apiResource('sales', SaleController::class);

    //Route::apiResource('sellers', SellerController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::apiResource('users', UserController::class);
});
