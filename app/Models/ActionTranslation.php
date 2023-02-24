<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'action_id',
        'locale',
        'url',
        'img',
        'img_small',
        'title',
        'description',
        'body',
        'keywords',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'seo_description',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public $timestamps = false;
}
