<?php

namespace App\Models;

use App\Contracts\ImagesOwnerContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Brand extends Model implements ImagesOwnerContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\BrandTranslation';
    protected $translationForeignKey = 'brand_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'url',
        'img',
        'title',
        'description',
        'body',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'seo_description',
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
        'link',
        'order',
        'slug',
        'image',
        'image_small',
        'status',
        'create_year',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function images(): HasMany
    {
        return $this->HasMany(BrandImage::class,'brand_id','id');
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(BrandImage::class)
            ->where('main', true);
    }

    public function gallery(): HasMany
    {
        return $this->images()->where('main', false);
    }

    public function getStorageUri(): string
    {
        return "brands/{$this->id}/gallery";
    }

    public function getImageUrlAttribute(): string
    {
        return $this->mainImage->url ?? '';
    }

    public function getImageFullUrlAttribute(): string
    {
        return $this->mainImage->fullUrl ?? '';
    }


    public function getNameAttribute(): string
    {
        return $this->title;
    }


    public function usersDiscount(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'discount_brand',
            'brand_id',
            'user_id'
        )->withPivot('discount');
    }
}
