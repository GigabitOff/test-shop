<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;

class ShopCity extends Model
{
    use
        HasFactory,
        Translatable;

    protected $translationModel = 'App\Models\ShopCityTranslation';
    protected $translationForeignKey = 'city_id';

    // protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'description',
        'body',
        'img',
        'h1',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_canonical',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'id',
        'name',
        'image',
        'slug',
        'url',
        'status'
    ];

    public function shopsShow()
    {
        return $this->hasMany(Shop::class, 'city_id', 'id')->where('status', 1);
        //->where('order', '!=', 1)
    }

    public function scopeOnlyActive($query)
    {
        $query->where('status', true);
    }

    public function scopeOnlyActiveShop($query)
    {
        $query->where('status', true);
    }

    public function scopeSearchByName($query, $value)
    {
        return $query->whereValid(true)
            ->where(function ($q) use ($value) {
                $q->where('name_uk', 'like', "{$value}%");
                $q->orWhere('name_uk', 'like', "м.{$value}%");
            })->orderBy('type');
    }

    public function scopeRegionCapitals($query)
    {
        $query->whereValid(true);

    }
}
