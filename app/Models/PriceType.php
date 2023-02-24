<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\PriceType
 *
 * @property int $id
 * @property int $id_1c
 * @property int $percent
 * @property-read \App\Models\PriceTypeTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PriceTypeTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType translated()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereId1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType withTranslation()
 * @mixin \Eloquent
 */
class PriceType extends Model
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;

    public $translatedAttributes = ['name'];

    public function productCounterparties(): BelongsToMany
    {
        return $this->belongsToMany(Counterparty::class,
            'counterparty_price_type_products',
            'price_type_id',
            'counterparty_id',
        );
    }

    public function groupCounterparties(): BelongsToMany
    {
        return $this->belongsToMany(Counterparty::class,
            'counterparty_price_type_groups',
            'price_type_id',
            'counterparty_id',
        );
    }

    public function productGroupsByCounterparty(): BelongsToMany
    {
        return $this->belongsToMany(ProductGroup::class,
            'counterparty_price_type_groups',
            'price_type_id',
            'product_group_id',
        );
    }

    public function productsByCounterparty(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,
            'counterparty_price_type_products',
            'price_type_id',
            'product_id',
        );
    }

    /** Attributes */

    /**
     * Множитель скидки для цены.
     * Что бы получить цену по скидке достаточно умножить цену на множитель
     *
     * @return float|int
     */
    public function getDiscountMultiplierAttribute()
    {
        return 1 - $this->percent/100;
    }
}
