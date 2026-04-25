<?php

namespace App\Http\Controllers;

use App\Models\order_items;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\product_order_track_histories;

class OrdersController extends Controller
{
    public function store(Request $request)
    {

        $cart = session('cart');

        if (!$cart) {
            return redirect()->back()->with('error', 'Cart kosong');
        }

        // 1. hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * ($item['quantity'] ?? 1);
        }

        // 2. buat orders (header)
        $order = orders::create([
            'userId' => Auth::id(),
            'orderDate' => now(),
            'paymentMethod' => 'COD',
            'orderStatus' => 'pending',
            'id_pemesanan' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price' => $total, // kalau ada kolomnya
        ]);

        // 3. masukkan ke order_items
        foreach ($cart as $productId => $item) {
            order_items::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'price' => $item['price'] ?? 0,
                'qty' => $item['quantity'] ?? 1,
                'subtotal' => ($item['price'] ?? 0) * ($item['quantity'] ?? 1),
            ]);
        }

        product_order_track_histories::create([
            'orderId' => $order->id,
            'status' => 'pending',
            'keterangan' => 'Pesanan dibuat',
            'tanggal' => now(),
        ]);

        // 4. kosongkan cart
        session()->forget('cart');

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat');
    }
}
