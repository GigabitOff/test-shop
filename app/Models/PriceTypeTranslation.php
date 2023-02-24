<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PriceTypeTranslation
 *
 * @property int $id
 * @property int $price_type_id
 * @property string $locale
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|PriceTypeTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceTypeTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceTypeTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceTypeTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceTypeTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceTypeTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceTypeTranslation wherePriceTypeId($value)
 * @mixin \Eloquent
 */
class PriceTypeTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
