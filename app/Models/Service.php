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
        'hashtag',
        'note',
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
        'price_sale_sum',
        'price_products_sum',
        'profit',
        'price_profit_sum',
        'show_calendar',
        'quantity',
        'age_limit',
        'abonement',
        'counterparty_id',
        'article',
        'service_time',
        'unit',
        'product_with_service',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'service_product')->withPivot('service_id', 'product_id','product_count');
    }


    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function getCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }

    public function counterparty()
    {
        return $this->belongsTo(Counterparty::class);
    }

    public function counterparties(): BelongsToMany
    {
        return $this->belongsToMany(Counterparty::class);
    }
}
