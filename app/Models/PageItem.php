<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class PageItem extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\PageItemTranslation';
    protected $translationForeignKey = 'page_item__id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'description',
        'body',
        'img',
        'url',
        'value',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'seo_canonical',
    ];

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected $fillable = [
        'id',
        'parent_id',
        'page_id',
        'slug',
        'name',
        'image',
        'icon',
        'status',
        'order',
        'slug',
        'type',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
