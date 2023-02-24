<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Banner extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    const USER_TYPE_UNREGISTERED = 'unregistered';
    const USER_TYPE_SIMPLE = 'simple';
    const USER_TYPE_LEGAL = 'legal';

    const USER_TYPES = [
        self::USER_TYPE_UNREGISTERED,
        self::USER_TYPE_SIMPLE,
        self::USER_TYPE_LEGAL,
    ];

    protected $translationModel = 'App\Models\BannerTranslation';
    protected $translationForeignKey = 'banner_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'url',
        'img',
        'title',
        'title_lable',
        'description',
        'body',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'id',
        'page_id',
        'page_location_id',
        'category_id',
        'user_id',
        'action_id',
        'order',
        'link',
        'image',
        'image_bg',
        'image_mobile',
        'status',
        'from_banner',
        'user_type',
    ];

    /**
     * Default values for attributes
     * @var  array an array with attribute as key and default as value
     */

    protected $attributes = [
        'user_type' => self::USER_TYPE_UNREGISTERED,
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(PageLocation::class, 'page_location_id');
    }

    public function getImageFullUrlAttribute(): string
    {
        return $this->image
            ? Storage::disk('public')->url($this->image)
            : '';
    }
    public function getImageMobileFullUrlAttribute(): string
    {
        return $this->image_mobile
            ? Storage::disk('public')->url($this->image_mobile)
            : '';
    }

}
