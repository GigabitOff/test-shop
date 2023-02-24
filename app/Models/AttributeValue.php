<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeValue extends Model
{
    use HasFactory;
    use Translatable;

    const FROM_CATEGORY = 'category';
    const FROM_ADMIN = 'admin';
    const FROM_API = 'api';

    public $timestamps = false;

    protected $table = 'attribute_values';
//    protected $primaryKey = 'id';

    public $translatedAttributes = ['name', 'slug'];

    protected $fillable = [
        'product_id',
        'attribute_id',
        'imported',
        'option',
        'from',       // Источник заполнения
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    /** ========== Scopes ========== */
    public function scopeOnlyImported(Builder $query)
    {
        $query->where('imported', true);
    }

    public function scopeOnlyFromCategory(Builder $query)
    {
        $query->where('from', self::FROM_CATEGORY);
    }

    /** ========== Attributes ========== */
    public function getIsFromCategoryAttribute(): bool
    {
        return $this->from === self::FROM_CATEGORY;
    }
}
