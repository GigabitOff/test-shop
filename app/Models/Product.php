<?php

namespace App\Models;

use App\Contracts\ImagesOwnerContract;
use App\Traits\HasAvailability;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model implements ImagesOwnerContract
{
    use HasFactory;
    use Translatable;
    use HasAvailability;

    public $timestamps = false;

    public $translatedAttributes = [
        'name',
        'description',
        'body',
        'short_description',
        'technical_description',
        'markdown_description',
        'manufacturer',
        'measure',
        'color_name',
        'seller',
        'country',
        'search_tags',
        'country_registration',
        'keywords',
        'status_product',
        'comment',
        'shipping_payment',
        'markdown_description',
        'seo_decription',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'state',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    // used for calculation price for different customer types or when manager is logged
    protected ?User $customer = null;
    protected ?PaymentType $paymentType = null;
    protected ?Counterparty $counterparty = null;

    protected $fillable = [
        'id_1c',
        'brand_id',
        'category_id',
        'slug',
        'group_id',
        'price_init',
        'price_rrc',
        'price_sale',
        'price_sale_show',
        'price_purchase',
        'price_wholesale',
        'price_retail',
        'price_min_margin',                   // double Маржа (min % прибыли)
        'comission',
        'depth',
        'width',
        'height',
        'weight',
        'foodstuff',                // bool Пищевой продукт
        'category_id_1c',
        'image',
        'image_id',
        'code_1c',
        'brand',
        'brand_search',
        'articul_search',
        'catalog_no',
        'catalog_no_search',
        'multiplicity',
        'warranty',
        'sort_order',
        'stock',
        'on_backorder',
        'show_stock',
        'reserve_minutes',
        'availability',
        'availability_supplier',
        'deleted',
        'imported',
        'recommended',
        'replacement_ids',
        'accompanying_ids',
        'cut_out',
        'articul',
        'unit',
        'length',
        'status',
        'status_app',
        'parental_type',
        'ext_id',
        'color',
        'vars_key',         // string Ключ связки разновидностей
        'vars_attrs',       // string Общие атрибуты для группы разновидностей
        'markdown',
        'new',
        'barcode',
        'uktved',
        'card_attribute',    // string Маркер атрибута отображемого в карточке товара
    ];

    const AVAILABILITY_OUT_OF_STOCK = 0;
    const AVAILABILITY_IN_STOCK = 1;
    const AVAILABILITY_SMALL_STOCK = 2;

    const AVAILABILITY_TYPES = [
        '0' => 0,// 'Немає в наявності',
        '1' => 1, //'В наявності',
        '2' => 2, // 'Мало',

    ];

    protected $casts = [
        'vars_attrs' => 'array',
    ];

    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attribute_values',
            'product_id',
            'attribute_id'
        );
    }

//    protected static function booted()
//    {
//        $userId = auth()->id();
//
//        static::addGlobalScope('withPrices', function (Builder $query) use($userId) {
//            $sub = DB::table('product_user_price')
//                ->where('user_id', $userId)
//                ->select('product_id as up_pid', 'calc_retail as user_price_retail', 'calc_wholesale as user_price_wholesale' );
//            $query->leftJoinSub($sub, 'pup', 'products.id', '=', 'pup.up_pid');
//        });
//    }

    public function instructions(): HasMany
    {
        return $this->HasMany(ProductInstruction::class, 'product_id', 'id');
    }

    public function attributesUnique()
    {
        return $this->attributes()->distinct();
    }

    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function allVariations(): HasMany
    {
        return $this->hasMany(Product::class, 'vars_key', 'vars_key');
    }

    public function variations(): EloquentCollection
    {
        return $this->allVariations->except($this->id);
    }

    public function termsBasic()
    {
        return $this->belongsToMany(Term::class)->withPivot('attribute_id', 'dop_attr', 'main')->where('main', 1);
    }

    public function termsAdditional()
    {
        return $this->belongsToMany(Term::class)->withPivot('attribute_id', 'dop_attr', 'main')->where('main', 0);
    }

    public function gallery(): HasMany
    {
        return $this->images()->where('main', false);
    }

    public function images(): HasMany
    {
        return $this->HasMany(ProductImage::class, 'product_id', 'id');
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)
            ->where('main', true);
    }

    public function getStorageUri(): string
    {
        return "product/{$this->id}/gallery";
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)
            ->using(ProductCategoryPivot::class);
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function favoritesUsers()
    {
        return $this->belongsToMany(User::class, 'product_favorites', 'product_id', 'user_id')
            ->withPivot(['quantity']);
    }

    public function deferredsGoods()
    {
        return $this->belongsToMany(User::class, 'product_deferreds', 'product_id', 'user_id')
            ->withPivot(['quantity']);
    }

    public function priceTypes(): BelongsToMany
    {
        return $this
            ->belongsToMany(PriceType::class, 'product_price_type')
            ->withPivot(['cash', 'cashless']);
    }

    public function replacements()
    {
        return $this->belongsToMany(Product::class, 'product_replacement', 'product_id', 'replacement_id');
    }

    public function comparisonProducts()
    {
        return $this->belongsToMany(Product::class, 'product_comparison_products', 'product_id', 'comparison_product_id');
    }

    public function accompanying()
    {
        return $this->belongsToMany(Product::class, 'product_accompanying', 'product_id', 'accompanying_id');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(ProductVisit::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('uuid', 'quantity', 'price', 'reserve', 'options');
    }

    public function orderedCount(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->selectRaw('sum(order_product.quantity) as aggregate')
            ->groupBy('pivot_product_id');
    }

    public function getOrderedCountAttribute()
    {
        if ( ! array_key_exists('orderedCount', $this->relations)) $this->load('orderedCount');

        $related = $this->getRelation('orderedCount')->first();

        return ($related) ? $related->aggregate : 0;
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_product', 'product_id', 'brand_id');
    }

    public function personalOffers()
    {
        return $this->belongsToMany(PersonalOffer::class);
    }

    public function personalOffersValid()
    {
        return $this->hasMany(PersonalOffer::class)
            ->where('quantity', '>', 0)
            ->where('date_end', '>=', Carbon::now()->toDateTimeString());
    }

    // Привязка фиктивного товара к персональному предложению.
    public function personalOffer(): BelongsTo
    {
        return $this->belongsTo(PersonalOffer::class);
    }

    /** Scopes */

    public function scopeOnlyNovelty($query)
    {
        $query->where('new', 1);
    }

    public function scopeOnlyMarkdown($query)
    {
        $query->where('markdown', 1);
    }

    public function scopeWithTerms($query)
    {
        return $query->with('terms', function ($q) {
            $q->with('translations');
        });
    }

    public function scopeWithAttributes($query)
    {
        return $query->with('attributes', function ($q) {
            $q->with('translations');
        });
    }

    public function scopeWithCategories($query)
    {
        return $query->with('categories', function ($q) {
            $q->with('translations');
        });
    }

    /** Attributes */
    public function getPriceAttribute()
    {
        $priceField = self::getPriceField($this->customer);
        return $this->{$priceField};
    }

    public function getMaxStockAttribute()
    {
        return $this->on_backorder
            ? null
            : $this->stock;
    }

    // Объем
    public function getVolumeAttribute()
    {
        return ($this->width / 1000)
            * ($this->height / 1000)
            * ($this->depth / 1000);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->mainImage->url ?? '';
    }

    public function getImageFullUrlAttribute(): string
    {
        return $this->mainImage->fullUrl ?? '';
    }

    /** Service Functions */
    /**
     * Определяет поле с ценой в БД
     *
     * @param  User|null  $user
     * @return string
     */
    //  Block for determining the type and type of prices in accordance with the type of user.
    public static function getPriceFieldWithParams(?User $user = null, $priceSale = null, $priceWholesale = null, $priceSaleShow = null): string
    {

        $user = $user ?? auth()->user();

        if (!$user) {
            //Not registered user
            if (!empty($priceSale) && $priceSale != 0 && $priceSaleShow != 0) {
                return 'price_sale';
            }  else {
                return 'price_rrc';
            }
        } elseif (is_object($user) && $user->is_founder != 0) {
            //User legal entity
            if (!empty($priceSale) && $priceSale != 0 && $priceSaleShow != 0) {
                return 'price_sale';
            } elseif (!empty($priceWholesale) && $priceWholesale != 0) {
                return 'price_wholesale';
            } else {
                return 'price_rrc';
            }
        } else {
            //User registered natural person
            if (!empty($priceSale) && $priceSale != 0 && $priceSaleShow != 0) {
                return 'price_sale';
            } elseif (!empty($priceWholesale) && $priceWholesale != 0) {
                return 'price_rrc';
            } else {
                return 'price_rrc';
            }
        }
    }

    public static function getPriceField(?User $user = null): string
    {
       $user = $user ?? auth()->user();
        return $user && $user->is_customer_legal
            ? 'price_sale'
            : 'price_rrc';
    }



    public function forCustomer(?User $customer = null): Product
    {
        $this->customer = $customer;
        return $this;
    }

    public function forPaymentType(?PaymentType $paymentType = null): Product
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    public function forCounterparty(?Counterparty $counterparty = null): Product
    {
        $this->counterparty = $counterparty;
        return $this;
    }


    public function getPersonalOffer(?string $uniq = null): ?PersonalOffer
    {
        $offerId = PersonalOffer::extractOfferIdFromUniq($uniq ?: $this->cartUniq);
        return $offerId
            ? $this->personalOffers()->where('id', $offerId)->first()
            : null;
    }

    /**
     * Формирует ссылку на товар и url картинки учитывая fallback image
     * @param  bool  $useImageFallback
     * @return array
     */
    public function compactUrlImage(bool $useImageFallback = true): array
    {
        $category = $this->categories->first();
        $url = route('products.show', ['product' => $this->id]);
        $image = ($this->imageFullUrl ?: ($category->imageFullUrl ?? ''))
            ?: ($useImageFallback ? config('app.fallback_photo') : '');

        return [$url, $image, $category];
    }
}
