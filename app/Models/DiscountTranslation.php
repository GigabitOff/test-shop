<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_id',
        'locale',
        'title',
        'description',
        'body',
    ];

    public $timestamps = false;
}
