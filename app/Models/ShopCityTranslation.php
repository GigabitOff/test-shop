<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\DB;


class ShopCityTranslation extends Model
{

    public $timestamps = false;

    protected $table = 'shop_city_translations';

    public function scopeSearchByName($query, $value)
    {
        return $query->whereValid(true)
            ->where(function ($q) use ($value) {
                $q->where('name_uk', 'like', "{$value}%");
                $q->orWhere('name_uk', 'like', "м.{$value}%");
            });
    }

    public function scopeRegionCapitals($query)
    {

        $query->get();
    }





}

