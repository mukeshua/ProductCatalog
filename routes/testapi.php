<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/test',function(){
    dd('$te');
});
Route::prefix('api/v1')->group(function () {
     Route::apiResource('products', ProductController::class);
     Route::apiResource('categories', CategoryController::class);
});