<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * @property bool isTypePropertyPrice
 * @property bool isTypeProductAttribute
 */
class FilterAttribute extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\FilterAttributeTranslation';
    protected $translationForeignKey = 'filter_attribute_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'description',
    ];

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected $fillable = [
        'id',
        'filter_id',
        'attribute_id',
        'show_type',
        'show_method',
        'column_product',
        'order',
        'order_type',
        'basic',
        'status',
        'collapsed',
        'show_title',
        'expanded_list',
        'search',
        'registered_user',
    ];

    public function attribute()
    {
        return $this->hasOne(Attribute::class, 'id', 'attribute_id');
    }

    public function getIsTypeProductAttributeAttribute(): bool
    {
        return (bool) $this->attribute_id;
    }

    public function getIsTypePropertyPriceAttribute(): bool
    {
        return $this->column_product == 'price_init';
    }

}
