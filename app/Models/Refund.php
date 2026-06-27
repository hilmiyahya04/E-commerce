<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReturnModel;

class Refund extends Model
{
    protected $fillable = [
        'return_id',
        'order_id',
        'amount',
        'status',
        'refunded_at',
    ];

    public function return()
    {
        return $this->belongsTo(ReturnModel::class, 'return_id');
    }

    public function order()
    {
        return $this->belongsTo(orders::class);
    }

    public function returnModel()
    {
        return $this->belongsTo(ReturnModel::class, 'return_id');
    }
}
