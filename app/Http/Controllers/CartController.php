<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id)
    {
        $product = product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->productName,
                "price" => $product->productPrice,
                "image" => $product->productImage1 ?? null,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item berhasil dihapus');
    }
}
