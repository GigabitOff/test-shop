<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 *
 * @property int $id
 * @property int $koatuu
 * @property string $name_uk
 * @property string $district_uk
 * @property string $region_uk
 * @property boolean $valid
 * @method static \Illuminate\Database\Eloquent\Builder searchByName($value)
 * @method static \Illuminate\Database\Eloquent\Builder regionCapitals()
 */
class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function scopeSearchByName($query, $value)
    {
        return $query->whereValid(true)
            ->where(function($q) use($value) {
                $q->where('name_uk', 'like', "{$value}%");
                $q->orWhere('name_uk', 'like', "м.{$value}%");
            })->orderBy('type');
    }

    public function scopeRegionCapitals($query)
    {
        return $query->whereValid(true)
            ->whereNull('type')->orderBy('name_uk');
    }

}
