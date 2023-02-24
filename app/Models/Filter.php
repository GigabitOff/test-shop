<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Filter extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translationModel = 'App\Models\FilterTranslation';
    protected $translationForeignKey = 'filter_id';

    protected $hidden = ['translations'];

    const POSITION_DESC = [
        'left'=>'left',
        'right'=>'right',
        'top'=>'top',
    ];

    const TYPE = [
        'text'=>'text',
        'checkbox'=>'checkbox',
        'radio'=> 'radio',
        'checkbox_icon'=>'checkbox_icon',
        'select'=>'select',
        'icon'=>'icon',
        'slider'=>'slider',
    ];

    const product_column = [
        //'brand_id' => 'brand_id',
       // 'category_id' => 'category_id',
        'price_init' => 'price_init',
       // 'application' => 'application',
    ];

    const show_method = [
        'default' => 'default',
        'scrolling' => 'scrolling',
        'show_all' => 'show_all',
    ];

    const order_type = [
        'ASC_numeric' => 'ASC_numeric',
        'DESC_numeric' => 'DESC_numeric',
        'ASC_string' => 'ASC_string',
        'DESC_string' => 'DESC_string',
    ];

    const POSITION_MOB = [
        'left'=>'left',
        'right'=>'right',
    ];

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
        'category_id',
        'user_id',
        'tmp',
        'name',
        'position',
        'type',
        'show_mobile',
        'position_mobile',
        'status',
    ];

    public function filterBaseItems()
    {
        return $this->hasMany(FilterAttribute::class)->where('basic',1)->where('status',1)->orderBy('order','ASC');
    }

    public function filterAdditionalItems()
    {
        $res = $this->hasMany(FilterAttribute::class)->where('basic', 0)->where('status', 1)->orderBy('order', 'ASC');

        return $res;
    }

    public function filterItems()
    {
        return $this->hasMany(FilterAttribute::class)->where('status',1)->orderBy('order','ASC');
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class,'parent_id', 'category_id');
    }

    public function getParentCategories()
    {
        $cat1 = $this->hasMany(Category::class, 'parent_id', 'category_id')->get();
        $parent_cat = [];
        foreach ($cat1 as $key => $value) {
            foreach ($value->parentData as $key_p => $value_p) {

            $parent_cat[$value_p->id] = $value_p;
            }
        }

        return $parent_cat;
    }


}
