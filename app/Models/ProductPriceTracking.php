<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceTracking extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'product_price',
    ];
}
