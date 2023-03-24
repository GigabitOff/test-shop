<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceTracking extends Model
{
    protected $table = 'product_price_tracking';
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'product_id',
        'product_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class)->with('trackingProducts');
    }
}
