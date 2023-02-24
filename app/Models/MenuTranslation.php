<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'locale',
        'url',
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
