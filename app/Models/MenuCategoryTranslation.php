<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_cat_id',
        'locale',
        'img',
        'title',
        'description',
        'body',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public $timestamps = false;
}
