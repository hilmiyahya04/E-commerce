<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productcontroller extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $products = \App\Models\Product::where('productName', 'like', "%{$search}%")->get();

        return view('product', compact('products'));
    }
}
