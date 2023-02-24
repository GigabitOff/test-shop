<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class MenuCategory extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\MenuCategoryTranslation';
    protected $translationForeignKey = 'menu_cat_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [

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
        'menu_id',
        'category_id',
        'order',
        'slug',
        'image',
        'status',
    ];

    public function category()
    {
        return $this->HasOne(Category::class,'id', 'category_id')->with('translations');
    }

    public function page()
    {
        return $this->HasOne(Page::class,'id', 'page_id');
    }


    // ---------- scope section ---------

    public function scopeOnlyActive($query){
        $query->where('status', true);
    }


}
