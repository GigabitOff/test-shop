<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable; 

class Vacancy extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\VacancyTranslation';
    protected $translationForeignKey = 'vacancy_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'url',
        'img',
        'h1',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'title',
        'title_image_1',
        'title_image_2',
        'title_image_3',
        'title_image_4',
        'text_image_1',
        'text_image_2',
        'text_image_3',
        'text_image_4',
        'tagline',
        'employment_lang',
        'schedule_lang',
        'whours_lang',
        'description',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected $fillable = [
        'id',
        'page_id',
        'city_id',
        'order',
        'slug',
        'link',
        'image',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'status',
        'schedule',
        'whours',
    ];


    public function getCity()
    {
        return $this->hasOne(ShopCity::class, 'id', 'city_id');
    }

}
