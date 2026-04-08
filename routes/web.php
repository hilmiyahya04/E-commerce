<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/product/{id}', function ($id) {
    $product = \App\Models\Product::findOrFail($id);
    return view('product_detail', compact('product'));
})->name('product.detail');

use Illuminate\Http\Request;

Route::post('/cart/add/{id}', function (Request $request, $id) {

    $product = \App\Models\Product::findOrFail($id);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $product->productName,
            "price" => $product->productPrice,
            "image" => $product->productImage1,
            "quantity" => 1
        ];
    }

    session()->put('cart', $cart);

    return back()->with('success', 'Produk masuk keranjang');
})->name('cart.add');


Route::get('/cart', function () {
    return view('cart');
})->name('cart.index'); 
