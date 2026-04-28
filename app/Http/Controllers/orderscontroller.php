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
        if ($request->product_id) {
            $product = \App\Models\Product::findOrFail($request->product_id);

            $order = orders::create([
                'userId' => Auth::id(),
                'orderDate' => now(),
                'paymentMethod' => 'COD',
                'orderStatus' => 'pending',
                'id_pemesanan' => 'ORD-' . strtoupper(Str::random(8)),
                'total_price' => $product->productPrice,
            ]);

            order_items::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->productName,
                'price' => $product->productPrice,
                'qty' => 1,
                'subtotal' => $product->productPrice,
            ]);

            product_order_track_histories::create([
                'orderId' => $order->id,
                'status' => 'pending',
                'keterangan' => 'Pesanan dibuat',
                'tanggal' => now(),
            ]);

            return redirect()->back()->with('success', 'Pesanan berhasil dibuat');
        }

        $cart = session('cart');

        if (!$cart) {
            return redirect()->back()->with('error', 'Cart kosong');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * ($item['quantity'] ?? 1);
        }

        $order = orders::create([
            'userId' => Auth::id(),
            'orderDate' => now(),
            'paymentMethod' => 'COD',
            'orderStatus' => 'pending',
            'id_pemesanan' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price' => $total,
        ]);

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

        session()->forget('cart');

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat');
    }
}
