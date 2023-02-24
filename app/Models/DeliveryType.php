<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeliveryType
 *
 * @property int $id
 * @property string $id_1c
 * @property-read \App\Models\DeliveryTypeTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeliveryTypeTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType translated()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType whereId1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryType withTranslation()
 * @mixin \Eloquent
 */
class DeliveryType extends Model
{
    use HasFactory;
    use Translatable;

    //  Константы соответствуют идентификаторам id_1c
    const DEFAULT = 'seed-self-pickup';
    const SELF_PICKUP = 'seed-self-pickup';
    const ADDRESS_DELIVERY = 'seed-address-delivery';
    const NOVA_POSHTA_SERVICE = '000000002';
    const DELIVERY_AUTO_SERVICE = 'seed-delivery-service';
    const SAT_SERVICE = 'seed-sat-service';

    public $timestamps = false;

    public $translatedAttributes = ['name'];

    public function isDefault(): bool
    {
        return $this->id_1c === self::DEFAULT;
    }
    public function isSelfPickupService(): bool
    {
        return $this->id_1c === self::SELF_PICKUP;
    }
    public function isAddressDeliveryService(): bool
    {
        return $this->id_1c === self::ADDRESS_DELIVERY;
    }
    public function isNovaPoshtaService(): bool
    {
        return $this->id_1c === self::NOVA_POSHTA_SERVICE;
    }
    public function isDeliveryAutoService(): bool
    {
        return $this->id_1c === self::DELIVERY_AUTO_SERVICE;
    }
    public function isSatService(): bool
    {
        return $this->id_1c === self::SAT_SERVICE;
    }
}
