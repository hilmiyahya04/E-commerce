<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order_items extends Model
{
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'qty',
        'price',
    ];
    public function order()
    {
        return $this->belongsTo(orders::class, 'order_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
