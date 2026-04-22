<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'userId',
        'orderDate',
        'paymentMethod',
        'orderStatus',
        'id_pemesanan',
        'total_price',
    ];
    public function items()
    {
        return $this->hasMany(order_items::class, 'order_id');
    }
}
