<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCityTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'locale',
        'title',
        'img',
        'description',
        'body',
        'link',
        'h1',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_canonical',
    ];

    public $timestamps = false;
}
