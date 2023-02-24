<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterSeoTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'filter_id',
        'locale',
        'title',
        'url',
        'seo_url',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public $timestamps = false;
}
