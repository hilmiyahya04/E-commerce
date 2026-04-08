<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product_order_track_histories extends Model
{
    use HasFactory;
    protected $table = 'product_order_track_histories';
    protected $fillable = [
        'orderId',
        'status',
        'remarks',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'orderId');
    }
}
