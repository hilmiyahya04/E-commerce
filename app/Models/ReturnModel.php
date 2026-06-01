<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    protected $table = 'returns';

    protected $fillable = [
        'order_item_id',
        'user_id',
        'reason',
        'image',
        'status',
        'admin_note',
    ];

    public function orderItem()
    {
        return $this->belongsTo(order_items::class, 'order_item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function refund()
    {
        return $this->hasOne(Refund::class, 'return_id');
    }
}
