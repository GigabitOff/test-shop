<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'body',
        'short_description',
        'technical_description',
        'markdown_description',
        'shipping_payment',
        'manufacturer',
        'measure',
        'color_name',
        'seller',
        'country',
        'search_tags',
        'country_registration',
        'keywords',
        'comment',
        'state',
        'markdown_description',
        'seo_decription',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
}
