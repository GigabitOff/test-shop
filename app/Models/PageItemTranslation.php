<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageItemTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'body',
        'img',
        'url',
        'value',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'seo_canonical',
    ];

    public $timestamps = false;
}
