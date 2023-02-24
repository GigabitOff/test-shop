<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class FilterSeo extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\FilterSeoTranslation';
    protected $translationForeignKey = 'filter_seo_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'description',
        'url',
        'seo_url',
        'h1',
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
        'name',
        'status',
    ];

}
