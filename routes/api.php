<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'Transaction created successfully',
        'data' => 55, // Return the created customer object
    ], 200);
});

// Group routes under a common prefix
Route::prefix('category/{slug}/products')->group(function () {
    Route::post('/', [CategoryController::class, 'fetchProducts'])->name('products.fetch');
});

