<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class News extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $table = 'news';

    public $translatedAttributes = [
        'title',
        'description',
        'description_short',
        'body',
        'img',
        'gallery',
        'h1',
        'keywords',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
    protected $translationForeignKey = 'news_id';

    protected $dates = [
          'updated_at',
         // 'created_at',
      ];

    protected $fillable = [
        'id',
        'parent_id',
        'page_id',
        'category_id',
        'user_id',
        'name',
        'slug',
        'image',
        'image_bg',
        'image_small',
        'galery',
        'status',
        'order',
        'link',
        'created_at',
];


    public function getTableName(){
        return 'news';
    }

}
