<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Action extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\ActionTranslation';
    protected $translationForeignKey = 'action_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'url',
        'img',
        'img_small',
        'title',
        'description',
        'body',
        'h1',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'keywords',
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
        'page_id',
        'user_id',
        'order',
        'slug',
        'image',
        'image_small',
        'status',
        'on_main',
        'date_start',
        'date_end',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('status');
    }
    public function visits(): HasMany
    {
        return $this->hasMany(ActionVisit::class);
    }
}
