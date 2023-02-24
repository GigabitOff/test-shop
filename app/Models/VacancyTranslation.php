<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacancy_id',
        'locale',
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

    public $timestamps = false;
}
