<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    $products = Product::all();

    $recommendations = collect();
    if (Auth::check()) {
        $service = new \App\Services\RecommendationService();
        $recommendations = $service->getRecommendations(Auth::id());
    }

    return view('welcome', compact('products', 'recommendations'));
});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/product/{id}', function ($id) {
    $product = Product::with('category')->findOrFail($id);
    return view('product_detail', compact('product'));
})->name('product.detail');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/cart', function () {
    return view('cart');
})->name('cart.index');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');


Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/orders', [OrdersController::class, 'store'])
    ->name('orders.store');

Route::get('/search', [ProductController::class, 'search'])
    ->name('product.search');

Route::post('/cart/increase/{id}', [CartController::class, 'increase'])
    ->name('cart.increase');

Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])
    ->name('cart.decrease');

// Rute untuk melihat isi keranjang belanja
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
