<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'lang',
        'title',
        'img',
        'posada',
        'description',
        'body',
        'address_lang',
        'h1',
        'schedule_lang',
        'whours_lang',
    ];

    public $timestamps = false;
}
