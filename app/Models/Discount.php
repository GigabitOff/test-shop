<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\DiscountTranslation';
    protected $translationForeignKey = 'discount_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'description',
        'body',
    ];

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected $fillable = [
        'id',
        'role',
        'slug',
        'status',
        'code',
        'percent',
        'date_start',
        'date_end',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'discount_category');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


}
