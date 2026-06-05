<?php

namespace App\Models;

use App\Policies\product_order_track_historiesPolicy;
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

    public function tracking()
    {
        return $this->hasMany(product_order_track_histories::class, 'order_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
