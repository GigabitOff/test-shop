<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Auth;

class Menu extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\MenuTranslation';
    protected $translationForeignKey = 'menu_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'url',
        'img',
        'title',
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
        'parent_id',
        'page_id',
        'user_id',
        'order',
        'slug',
        'image',
        'status',
    ];

     public function MenuChild()
    {
        return $this->HasMany(Menu::class, 'parent_id','id')->where('status', 1)->orderby('order');
    }

    public function MenuCategory()
    {
        return $this->HasMany(MenuCategory::class, 'menu_id','id');
    }
    public function MenuChildAdmin()
    {
        return $this->HasMany(Menu::class, 'parent_id','id')->orderby('order');
    }


}
