<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shop extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    protected $translationForeignKey = 'shop_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'img',
        'description',
        'body',
        'address_lang',
        'h1',
        'schedule_lang',
        'whours_lang',
    ];

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected $fillable = [
        'id',
        'page_id',
        'city_id',
        'address',
        'coords',
        'coords_latitude',
        'coords_longitude',
        'emails',
        'email',
        'phones',
        'order',
        'phone',
        'schedule',
        'whours',
        'image',
        'status',
    ];

    public function getCity()
    {
        return $this->hasOne(ShopCity::class, 'id', 'city_id')->where('status', 1);
    }

    public function getContuct()
    {
        return $this->hasOne(Contuct::class, 'shop_id', 'id')->where('status', 1);
    }

    public function getContucts()
    {
        return $this->hasMany(Contuct::class, 'shop_id', 'id')->where('status', 1);
    }

    public function getVacancies()
    {
        return $this->hasMany(Vacancy::class, 'shop_id', 'id')->where('status', 1);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function shopCity(): BelongsTo
    {
        return $this->belongsTo(ShopCity::class, 'city_id');
    }

    public function scopeOnlyActive($query)
    {
        $query->where('status', true);
    }

}
