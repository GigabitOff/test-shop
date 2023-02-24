<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeliveryTypeTranslation
 *
 * @property int $id
 * @property int $delivery_type_id
 * @property string $locale
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTypeTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTypeTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTypeTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTypeTranslation whereDeliveryTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTypeTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTypeTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTypeTranslation whereName($value)
 * @mixin \Eloquent
 */
class DeliveryTypeTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
