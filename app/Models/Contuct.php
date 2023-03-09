<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Contuct extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    protected $translationForeignKey = 'contuct_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'name',
        'fio',
        'img',
        'posada',
        'description',
        'body',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected $fillable = [
        'id',
        'user_id',
        'shop_id',
        'parent_id',
        'emails',
        'email',
        'phones',
        'phone',
        'image',
        'status',
        'order',
    ];

    public function getParent()
    {
        return $this->hasOne(Contuct::class, 'id', 'parent_id');
    }

    public function getSelf()
    {
        return $this->hasOne(Contuct::class,'parent_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_contuct')->withPivot('send_mail');
    }

    public function popups(): BelongsToMany
    {
        return $this->belongsToMany(Popup::class, 'popup_contucts');
    }


    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function getCity()
    {
        return $this->belongsTo(ShopCity::class,'city_id','id');
    }

}
