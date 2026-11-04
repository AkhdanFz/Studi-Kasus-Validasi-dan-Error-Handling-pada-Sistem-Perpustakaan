<?php

use App\Modules\Products\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::post('products/{product}/reduce-stock/{quantity}', [ProductController::class, 'reduceStock'])
        ->whereNumber('quantity')
        ->name('products.reduce-stock');

    Route::resource('products', ProductController::class);
});