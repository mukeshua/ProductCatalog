<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/v1')->group(function () {

    Route::middleware('throttle:60,1')->group(function () {
        Route::GET('products/{category_id?}/{search?}', [ProductController::class, 'index']);
        Route::GET('product/{id}', [ProductController::class, 'show']);
        Route::POST('products', [ProductController::class, 'store']);
        Route::PUT('products/{id}', [ProductController::class, 'update']);
        Route::DELETE('products/{id}', [ProductController::class, 'destroy']);
    });
    
    Route::middleware('throttle:60,1')->group(function () {
        Route::GET('categories', [CategoryController::class, 'index']);
        Route::GET('categories/{id}', [CategoryController::class, 'show']);
        Route::POST('categories', [CategoryController::class, 'store']);
        Route::PUT('categories/{id}', [CategoryController::class, 'update']);
        Route::DELETE('categories/{id}', [CategoryController::class, 'destroy']);
    });
});