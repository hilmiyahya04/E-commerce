<?php

namespace App\Models;

use App\Filament\Resources\Orders\Schemas\OrdersForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_details extends Model
{
    use HasFactory;
    protected $table = 'product_details'; // Nama tabel di database
    protected $fillable = [
        'orderId',
        'productId',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'orderId');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
