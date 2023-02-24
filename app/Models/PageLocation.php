<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PageLocation extends Model
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;

    public array $translatedAttributes = [
        'title',
    ];

    protected $fillable = [
        'type',
    ];

    const TYPE_BANNER = 'banner';

    const TYPES = [
        'banner' => self::TYPE_BANNER,
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function banner(): HasOne
    {
        return $this->hasOne(Banner::class, 'page_location_id');
    }

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class, 'page_location_id');
    }

    //---- Scopes ----

    /**
     * @param Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    public function scopeOnlyTypeBanner($query)
    {
        $query->where('type', self::TYPE_BANNER);
    }

    //---- Checkers ----

    public function isTypeBanner(): bool
    {
        return $this->type === self::TYPE_BANNER;
    }

}
