<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    private function getCartItems()
    {
        // Menggunakan Auth::check() secara eksplisit agar dikenali teks editor
        if (Auth::check()) {
            $items = CartItem::where('user_id', Auth::id())->with('product')->get();
            $cart = [];

            foreach ($items as $item) {
                if ($item->product) {
                    $cart[$item->product_id] = [
                        "id" => $item->product_id,
                        "name" => $item->product->productName,
                        "price" => $item->product->productPrice,
                        "image" => $item->product->productImage1 ?? null,
                        "quantity" => $item->quantity
                    ];
                }
            }
            return $cart;
        }

        // Jika belum login, ambil dari cookie bernama 'guest_cart'
        return json_decode(request()->cookie('guest_cart'), true) ?? [];
    }

    /**
     * Helper internal untuk menyimpan perubahan keranjang (Cookie atau DB)
     */
    private function saveCartItems($cart)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            CartItem::where('user_id', $userId)->delete();
            foreach ($cart as $productId => $item) {
                CartItem::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $item['quantity']
                ]);
            }
        } else {
            // Jika belum login, simpan ke cookie browser (Awet selama 7 hari)
            Cookie::queue('guest_cart', json_encode($cart), 60 * 24 * 7);
        }
    }

    public function index()
    {
        // Mengambil data keranjang saat ini (dari Cookie atau Database)
        $cart = $this->getCartItems();

        // Mengirim data array $cart ke file blade bernama 'cart' (atau sesuaikan dengan file Anda)
        return view('cart', compact('cart'));
    }


    public function add($id)
    {
        $product = product::findOrFail($id);
        $cart = $this->getCartItems();

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

        $this->saveCartItems($cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function remove($id)
    {
        if (Auth::check()) {
            // Jika login, langsung hapus baris spesifik di database
            CartItem::where('user_id', Auth::id())->where('product_id', $id)->delete();
        } else {
            // Jika guest, hapus dari array cookie
            $cart = $this->getCartItems();
            if (isset($cart[$id])) {
                unset($cart[$id]);
            }
            $this->saveCartItems($cart);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus');
    }

    public function increase($id)
    {
        $cart = $this->getCartItems();

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $this->saveCartItems($cart);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function decrease($id)
    {
        $cart = $this->getCartItems();

        if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
            $this->saveCartItems($cart);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
