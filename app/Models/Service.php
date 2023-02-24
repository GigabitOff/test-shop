<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\ServiceTranslation';
    protected $translationForeignKey = 'service_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'description',
        'body',
        'img',
        'gallery',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_canonical',
        'search_tags',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'image',
        'slug',
        'order',
        'date_start',
        'date_end',
        'status',
        'price',
        'show_calendar',
        'quantity',
        'age_limit',
        'abonement',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'service_product');
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function getCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }

}
