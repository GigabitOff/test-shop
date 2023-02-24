<?php

namespace App\Models;

use App\Contracts\ImagesOwnerContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model implements ImagesOwnerContract
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;

    public $translatedAttributes = [
        'name',
        'url',
        'title',
        'manufacturer',
        'canonical',
        'description',
        'technical_description',
        'img',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'meta_title',
        'meta_keywords',
    ];

    protected $fillable = [
        'id_1c',
        'parent_id_1c',
        'link',
        'slug',
        'on_main',
        'sort_order',
        'filter_order',
        'filter_status',
        'filter_for_desctop',
        'filter_for_mobile',
        'image',
        'status',
        'parent_id',
        'brand_id',
        'facebook',
        'instagram',
        'youtube',
        'image_small',
    ];

    public function parentData()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->orderBy('sort_order', 'ASC');
    }

    /**
     * Родительская категория
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * Дочерние категории
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function child_data()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->orderBy('sort_order', 'ASC');
    }


    public function parentDataForFilter()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->orderBy('filter_order', 'ASC');
    }

    public function filters(): HasMany
    {
        return $this->hasMany(Filter::class);
    }

    public function selfCategory()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function selfCategories()
    {
        return $this->hasMany(Category::class,'parent_id', 'id');
    }

    public function selfFirstCategory()
    {
        $res = $this->hasOne(Category::class, 'id', 'parent_id');
        if($res->first()->parent_id != 0)
        $res = $res->first()->selfCategory;

        //dd($res);

        if ($res->first()->parent_id != 0)
        $res = $res->first()->selfCategory;

        return $res;

    }

    public function analogProducts()
    {
        return $this->belongsToMany(Product::class, 'category_analog_products');
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'category_related_products');
    }

    public function analogCategories()
    {
        return $this->belongsToMany(Category::class, 'category_analog_categories', 'category_id', 'related_id');
    }
    public function relatedCategories($table_name = 'category_related_categories')
    {
        return $this->belongsToMany(Category::class, $table_name, 'category_id', 'related_id');
    }

    public function relatedCategory($table_name = 'category_related_categories')
    {
        return $this->belongsToMany(Category::class, $table_name, 'category_id', 'related_id')->get();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Товары для которых категория является главной
     *
     * @return HasMany
     */
    public function mainProducts(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function imageProducts()
    {
        $prodSql = $this->belongsToMany(Product::class)->select('id')->toRawSql();
        return $prodImage = ProductImage::whereInRaw('product_id', $prodSql)->first();
      //  dd($prodImage);
       // return $this->belongsToMany(Product::class);
    }

    public function productsMaxPrice()
    {
        $data = $this->belongsToMany(Product::class)->orderBy('price_init', 'DESC');
        return $data;
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function brandImage()
    {
        return $this->belongsTo(Brand::class)->image;
    }


    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'category_attribute')
            ->withPivot('category_id','attribute_id', 'main');
    }

    public function base_attributes()
    {
       // return $this->belongsToMany(Attribute::class, 'category_attribute');
        return $this->belongsToMany(Attribute::class, 'category_attribute')->where('main', 1);
    }

    public function additiona_attributes()
    {
        return $this->belongsToMany(Attribute::class, 'category_attribute')->where('main', 0);
    }

    /*public function baseAttributes()
    {
        return $this->belongsToMany(Attribute::class, 'category_attribute')->where('main', 1);
    }

    public function additionalAttributes()
    {

        return $this->belongsToMany(Attribute::class, 'category_attribute')->where('main', 0);
    }*/

    public function allAttributes($withTerms='attributes', $attr_input=null)
    {
        // Old version with eager loading
        //        $data = $this->belongsToMany(Product::class)
        //            ->with('attributes.translations')
        //            ->with('terms.translations')->get();
        //$data = $this->belongsToMany(Product::class)->with('attributes')->with($withTerms)->get();
        //dd($attr_input);
        $data = $this->belongsToMany(Product::class)
            //->with('attributes.translations')
            ->with($withTerms . '.translations')->get();
        $tmp = [];
        $tmp2 = [];
        foreach ($data as $key_atr => $item) {

            if (count($item->terms) > 0) {

                $terms = $item->terms->keyBy('attribute_id');
                foreach ($terms as $key_term => $value_term) {
                    //dd($value_term);
                    //if(isset($attr_input) AND isset($attr_input[$value_term->attribute_id])){
                  //  $tmp2[$value_term->attribute->name][$value_term->id] = $value_term->value;
                  //  }elseif($attr_input == null){
                        $tmp2[$value_term->attribute->name][$value_term->id] = $value_term->value;

                  //  }

                    //$this->data_in_product[$value_term->attribute_id][$key_term] = $value_term;
                    //if (isset($this->additionalFilters[$key_term]) and $value_term) {
                       // $this->additionalFilters[$key_term]['term_data'][$value_term->id] = $value_term;
                       // $this->additionalFilters[$key_term]['term_data_sort'][$value_term->value] = $value_term;
                    //}
                    /*
                    if (isset($item->relations[$withTerms][$key_atr]))
                    $check = $item->relations[$withTerms][$key_atr]->value;
                    if (isset($check) and isset($tmp[$value_atr->name]) and $check !== '' and $tmp[$value_atr->name] != '') {
                        $tmp[$value_atr->name] = $tmp[$value_atr->name] . ',' . $check;
                    } else {
                        $tmp[$value_atr->name] = $check;
                    }
                    */
                }
                foreach ($tmp2 as $key => $value) {
                    $tmp[$key] = implode(",", $value);
                    # code...
                }
            }
            // dd($item->relations[$withTerms]);
            /*     if (count($item->relations['attributes']) > 0) {

                foreach ($item->relations['attributes'] as $key_atr => $value_atr) {
                    //dd($item->relations['termsBasic'][$key_atr]);
                    if($withTerms !== 'terms'){
                        //dd($item->relations[$withTerms]);
                       // dd($item->relations[$withTerms][$key_atr]);
                    if(isset($item->relations[$withTerms][$key_atr])){
                        $attr_id = $item->relations[$withTerms][$key_atr]->attribute_id;
                        //dd($value_atr);
                        if(isset($attr_id))
                        $tmp[$attr_id] = $value_atr;
                        }
                    }else{

                    if(isset($item->relations[$withTerms][$key_atr]))
                    $check = $item->relations[$withTerms][$key_atr]->value;
                    if (isset($check) AND isset($tmp[$value_atr->name]) and $check !== '' and $tmp[$value_atr->name] != '') {
                        $tmp[$value_atr->name] = $tmp[$value_atr->name] . ',' . $check;
                    } else {
                        $tmp[$value_atr->name] = $check;
                    }
                    }
                }
            }*/

        }
        //->terms->where('attribute_id', $item_atr->id)->pluck('value')->join(', ')
      //  dd($tmp);
        return $tmp;
    }

    public function getTermsAttributesForFilter($category_id=null)
    {
        $withTerms = 'terms';
        $data = $this->belongsToMany(Product::class)
            ->with('attributes.translations')
            ->with('terms.translations')->get();
        // dd($data);
        $tmp = [];
        foreach ($data as $key => $item) {
            // dd($item->relations[$withTerms]);
            if (count($item->relations['attributes']) > 0) {

                foreach ($item->relations['attributes'] as $key_atr => $value_atr) {
                    //dd($item->relations['termsBasic'][$key_atr]);
                        if (isset($item->relations[$withTerms][$key_atr]))
                            $check = $item->relations[$withTerms][$key_atr]->value;
                        if (isset($check) and isset($tmp[$value_atr->name]) and $check !== '' and $tmp[$value_atr->name] != '') {
                            $tmp[$value_atr->name] = $tmp[$value_atr->name] . ',' . $check;
                        } else {
                            $tmp[$value_atr->name] = $check;
                        }

                }
            }
        }
        //->terms->where('attribute_id', $item_atr->id)->pluck('value')->join(', ')
        //dd($tmp);
        return $tmp;
    }

    public function filterAdditionalAttributes($category_id=null)
    {
        $data = $this->belongsToMany(Product::class)
            ->with('attributes.translations')->get();
        $tmp = [];

      //  if($category_id == 532)
        //dd($category_id);
       // dd($data);
        foreach ($data as $key => $item) {
            if (count($item->relations['attributes']) > 0) {
                 foreach ($item->relations['attributes'] as $key_atr => $value_atr) {

                    //$check = $item->relations['terms'][$key_atr]->value;
                    /** Отримуєм атребути для фільтра */
                    //$tmp['attributes'][$value_atr->id]['terms'] = $item->relations['terms'];
                    if($value_atr->basic == 1){
                        $tmp['basic'][$value_atr->id] = $value_atr->id;

                    }else{
                        $tmp['additional'][$value_atr->id] = $value_atr->id;

                    }
                    /** Отримуєм бренди для фільтра */
                   // if(isset($item->brand_id))
                   // $tmp['brand_id'][$item->brand_id] = $item;
                }
            }
        }


        return $tmp;
    }

    public function images(): HasMany
    {
        return $this->HasMany(CategoryImage::class,'category_id','id');
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(CategoryImage::class)
            ->where('main', true);
    }

    public function gallery(): HasMany
    {
        return $this->images()->where('main', false);
    }

    public function getStorageUri(): string
    {
        return "category/{$this->id}/gallery";
    }

    public function getImageUrlAttribute(): string
    {
        return $this->mainImage->url ?? '';
    }

    public function getImageFullUrlAttribute(): string
    {
        return $this->mainImage->fullUrl ?? '';
    }

    /** ========== Scopes ========== */

    public function scopeOnlyRoot($query)
    {
        $query->where(function ($q){
            $q->whereNull('parent_id');
            $q->orWhere('parent_id', 0);
        });
    }
}
