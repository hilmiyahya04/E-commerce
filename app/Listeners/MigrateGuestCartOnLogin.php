<?php

namespace App\Listeners;

use App\Models\CartItem;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cookie;

class MigrateGuestCartOnLogin
{
    public function handle(Login $event): void
    {
        $user = $event->user;

        // 1. Ambil data keranjang dari cookie browser
        $guestCart = json_decode(request()->cookie('guest_cart'), true);

        if ($guestCart) {
            foreach ($guestCart as $productId => $item) {
                // 2. Cari apakah produk sudah ada di database user tersebut
                $existingItem = CartItem::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->first();

                if ($existingItem) {
                    // Jika sudah ada, tambahkan jumlahnya
                    $existingItem->update([
                        'quantity' => $existingItem->quantity + $item['quantity']
                    ]);
                } else {
                    // Jika belum ada, buat pencatatan baru di database
                    CartItem::create([
                        'user_id' => $user->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                    ]);
                }
            }

            // 3. Hapus cookie tamu karena data sudah aman dipindah ke database
            Cookie::queue(Cookie::forget('guest_cart'));
        }
    }
}
