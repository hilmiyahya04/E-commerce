<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\order_items;
use App\Models\orders;
use App\Models\product_order_track_histories;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        // PESAN LANGSUNG DARI PRODUCT DETAIL
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

            // Kirim notifikasi ke semua admin
            $this->notifyAdmins($order);

            return redirect()->back()->with('success', 'Pesanan berhasil dibuat');
        }

        // CHECKOUT DARI CART
        $cart = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Cart kosong');
        }

        $total = 0;

        foreach ($cart as $item) {
            if ($item->product) {
                $total += $item->product->productPrice * $item->quantity;
            }
        }

        $order = orders::create([
            'userId' => Auth::id(),
            'orderDate' => now(),
            'paymentMethod' => 'COD',
            'orderStatus' => 'pending',
            'id_pemesanan' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price' => $total,
        ]);

        foreach ($cart as $item) {
            if (!$item->product) continue;

            order_items::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'product_name' => $item->product->productName,
                'price' => $item->product->productPrice,
                'qty' => $item->quantity,
                'subtotal' => $item->product->productPrice * $item->quantity,
            ]);
        }

        product_order_track_histories::create([
            'orderId' => $order->id,
            'status' => 'pending',
            'keterangan' => 'Pesanan dibuat',
            'tanggal' => now(),
        ]);

        // Kosongkan cart setelah checkout
        CartItem::where('user_id', Auth::id())->delete();

        // Kirim notifikasi ke semua admin
        $this->notifyAdmins($order);

        return redirect()->back()->with('success', 'Checkout berhasil');
    }

    // Kirim notifikasi ke semua user yang punya role super_admin
    private function notifyAdmins(orders $order)
    {
        $admins = User::role('super_admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewOrderNotification($order));
        }
    }
}