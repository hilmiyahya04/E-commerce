<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'productCode',
        'productName',
        'productCompany',
        'productPrice',
        'productImage1',
        'productImage2',
        'productImage3',
        'productAvailability',
        'postingDate',
        'categoryId'
    ];
}
