<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

// Group routes under a common prefix
Route::prefix('category/{slug}/products')->group(function () {
    Route::post('/', [CategoryController::class, 'fetchProducts'])->name('products.fetch');
});

