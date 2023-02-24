<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Review extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    protected $translationForeignKey = 'review_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'fio',
        'body',
    ];

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'name',
        'email',
        'phone',
        'rating',
        'text',
        'user_confirm',
        'date_confirm',
        'status',
    ];

    public function getProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_confirm');
    }
}
