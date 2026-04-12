<?php

namespace App\Http\Controllers;

use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        orders::create([
            'userId' => Auth::id(),
            'orderDate' => now(),
            'paymentMethod' => 'COD',
            'orderStatus' => 'pending',
            'id_pemesanan' => 'ORD-' . strtoupper(Str::random(8)),
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat');
    }
}
