<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'locale',
        'url',
        'img',
        'title',
        'description',
        'body',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'seo_description',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public $timestamps = false;
}
