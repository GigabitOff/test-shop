<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Page extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\PageTranslation';
    protected $translationForeignKey = 'page_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'slogan',
        'slogan_description',
        'description',
        'subtitle',
        'title_description',
        'body',
        'img',
        'gallery',
        'h1',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_canonical',
    ];

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected $fillable = [
        'id',
        'parent_id',
        'user_id',
        'slug',
        'name',
        'image',
        'image_bg',
        'image_banner',
        'image_small',
        'status',
        'hidden',
        'main_menu',
        'top_menu',
        'slogan',
        'slogan_description',
        'footer_menu',
    ];


    const PAGE_SLUG = [
        'main'=>'main',
        'services'=> 'services',
        'shops'=> 'shops',
        'about' => 'about',
        'delivery-payment' => 'delivery-payment',
        'jobs' => 'jobs',
        'vacancies' => 'vacancies',
        'actions' => 'actions',
        'news'=>'news',
        'brands'=>'brands',
        'reviews'=>'reviews',
    ];

    public function getUpperPage()
    {
        return $this->hasOne(Page::class, 'id', 'parent_id');
    }

    public function getMenuItem($item)
    {
        $res = Menu::where('slug', 'career')->get();
        //dd($res);
        return Menu::where('slug', $item)->get()->first();
    }

    public function PageChild()
    {
        return $this->HasMany(Page::class, 'parent_id', 'id');
    }

    public function parentData()
    {
        return $this->hasMany(Page::class,'parent_id', 'id');
    }

    public function PageItems()
    {
        return $this->HasMany(PageItem::class, 'page_id', 'id');
    }

    public function getJobs()
    {
        return $this->HasMany(Vacancy::class, 'page_id', 'id')->where('status',1);
    }

    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(PageLocation::class);
    }

    //---- Scopes ----

    public function scopeOnlyActive($query)
    {
        $query->where('status', 1);
    }
}
