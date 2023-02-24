<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAnalogProduct extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'product_id',
    ];

    public function products()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
