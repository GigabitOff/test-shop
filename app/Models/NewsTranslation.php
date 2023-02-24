<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'locale',
        'title',
        'img',
        'gallery',
        'description',
        'body',
        'keywords',
        'h1',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public $timestamps = false;
}
