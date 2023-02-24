<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class ProductImport extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    const TYPE_XML = 'xml';
    const TYPE_CSV = 'csv';
    const TYPE_XLS = 'xls';

    const TYPES = [
        'xml' => self::TYPE_XML,
        'csv' => self::TYPE_CSV,
        'xls' => self::TYPE_XLS,
    ];

    const STATE_PENDING = 'pending';
    const STATE_PROCESSING = 'processing';
    const STATE_SUCCESS = 'success';
    const STATE_ERROR = 'error';

    protected $translationModel = 'App\Models\ProductImportTranslation';
    protected $translationForeignKey = 'import_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'title',
        'description',
        //'subtitle',
        'title_description',
        'body',
        'img',
        'gallery',
        //'h1',
        'seo_url',
        'seo_h1',
        'seo_h2',
        'seo_h3',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'seo_canonical',
    ];

    protected $fillable = [
        'name',
        'type',
        'state',
        'status',
        'order',
        'source_file',
        'result_file',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
        'errors' => 'array',
        'processed_at' => 'datetime',
    ];

    protected static array $defaultOptions = [
        'category' => ['value' => 'category', 'field_type' => 'string', 'import_type' => ['xml']],
        'category_id_attribute' => ['value' => 'id', 'field_type' => 'string', 'import_type' => ['xml']],
        'category_parent_id_attribute' => ['value' => 'parentId', 'field_type' => 'string', 'import_type' => ['xml']],
        'product' => ['value' => 'offer', 'field_type' => 'string', 'import_type' => ['xml']],
        'product_id_attribute' => ['value' => 'id', 'field_type' => 'string', 'import_type' => ['xml']],
        'product_id' => ['value' => 'id', 'field_type' => 'string', 'import_type' => ['csv', 'xls']],
        'product_category_id' => ['value' => 'category_id', 'field_type' => 'string', 'import_type' => []],
        'seller' => ['value' => 'seller', 'field_type' => 'string', 'import_type' => []],
        'article' => ['value' => 'sku', 'field_type' => 'string', 'import_type' => []],
        'name' => ['value' => 'name', 'field_type' => 'string', 'import_type' => []],
        'description' => ['value' => 'description', 'field_type' => 'string', 'import_type' => []],
        'price_rrp' => ['value' => 'price_rrp', 'field_type' => 'string', 'import_type' => []],
        'price_purchase' => ['value' => 'price_purchase', 'field_type' => 'string', 'import_type' => []],
        'multiplicity' => ['value' => 'multiplicity', 'field_type' => 'string', 'import_type' => []],
//        'price_rate' => 1,
        'stock' => ['value' => 'stock', 'field_type' => 'string', 'import_type' => []],
        'availability_attribute' => ['value' => 'availability', 'field_type' => 'string', 'import_type' => ['xml']],
//        'availability_vendor' => ['value' => 'availability_vendor', 'field_type' => 'string', 'import_type' => ['xml']],
        'brand' => ['value' => 'brand', 'field_type' => 'string', 'import_type' => []],
        'warranty' => ['value' => 'warranty', 'field_type' => 'string', 'import_type' => []],
        'measure' => ['value' => 'measure', 'field_type' => 'string', 'import_type' => []],
        'width' => ['value' => 'width', 'field_type' => 'string', 'import_type' => []],
        'length' => ['value' => 'length', 'field_type' => 'string', 'import_type' => []],
        'height' => ['value' => 'height', 'field_type' => 'string', 'import_type' => []],
        'weight' => ['value' => 'weight', 'field_type' => 'string', 'import_type' => []],
        'color' => ['value' => 'color', 'field_type' => 'string', 'import_type' => []],
        'country_origin' => ['value' => 'country_origin', 'field_type' => 'string', 'import_type' => []],
        'country_brand' => ['value' => 'country_brand', 'field_type' => 'string', 'import_type' => []],
        'photo' => ['value' => 'photo', 'field_type' => 'string', 'import_type' => []],
        'param' => ['value' => 'param', 'field_type' => 'string', 'import_type' => ['xml']],
        'param_key_attribute' => ['value' => 'name', 'field_type' => 'string', 'import_type' => []],
        'main_delimiter' => ['value' => ',', 'field_type' => 'string', 'import_type' => ['csv']],
        'attribute_prefix' => ['value' => 'attr_', 'field_type' => 'string', 'import_type' => ['csv', 'xls']],
        'attribute_value_prefix' => ['value' => 'attr_value_', 'field_type' => 'string', 'import_type' => ['csv', 'xls']],
        'nullify_stock_if_not_found' => ['value' => false, 'field_type' => 'bool', 'import_type' => []],
        'reload_price' => ['value' => true, 'field_type' => 'bool', 'import_type' => []],
//        'reload_all' => ['value' => false, 'field_type' => 'bool', 'import_type' => []],
//        'reload_name' => ['value' => false, 'field_type' => 'bool', 'import_type' => []],
//        'reload_description' => ['value' => false, 'field_type' => 'bool', 'import_type' => []],
//        'reload_warranty' => ['value' => false, 'field_type' => 'bool', 'import_type' => []],
//        'reload_category' => ['value' => false, 'field_type' => 'bool', 'import_type' => []],
//        'reload_brand' => ['value' => false, 'field_type' => 'bool', 'import_type' => []],
//        'reload_photos' => ['value' => false, 'field_type' => 'bool', 'import_type' => []],
//        'reload_characteristics' => ['value' => false, 'field_type' => 'bool', 'import_type' => []],
//        'ignore_empty_values' => ['value' => false, 'field_type' => 'bool', 'import_type' => []],
    ];

    /**
     * Отбирает элементы по типу импорта
     *
     * @param string $importType
     * @return array|array[]
     */
    public static function getDefaultOptions(string $importType = ''): array
    {
        return $importType
            ? array_filter(self::$defaultOptions, function ($el) use($importType) {
                return
                    empty($el['import_type']) ||
                    in_array($importType, $el['import_type']);
            })
            : self::$defaultOptions;
    }

    public static function getDefaultValueOptions(): array
    {
        return array_map(fn($el) => $el['value'], self::$defaultOptions);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->options = array_merge(self::getDefaultValueOptions(), $model->options ?? []);
        });
    }

    public function scopeNotExecuted($query)
    {
        $query->whereNull('processed_at');
    }

    public function scopeNotProcessing($query)
    {
        $query->where('state', '!=', self::STATE_PROCESSING);
    }

    public function scopeOnlyRepeatable($query)
    {
        $query->whereNotNull('processed_at');
        $query->where('repeatable', 1);
    }

    public function scopeOnlyEnabled($query)
    {
        $query->where('status', 1);
    }

    public function isTypeXml(): bool
    {
        return $this->type === self::TYPE_XML;
    }

    public function isTypeCsv(): bool
    {
        return $this->type === self::TYPE_CSV;
    }

    public function isTypeXls(): bool
    {
        return $this->type === self::TYPE_XLS;
    }

    public function isStatePending(): bool
    {
        return $this->state === self::STATE_PENDING;
    }

    public function isStateProcessing(): bool
    {
        return $this->state === self::STATE_PROCESSING;
    }

    public function isStateSuccess(): bool
    {
        return $this->state === self::STATE_SUCCESS;
    }

    public function isStateError(): bool
    {
        return $this->state === self::STATE_ERROR;
    }

    public function isStateExecuted(): bool
    {
        return $this->state === self::STATE_SUCCESS
            || $this->state === self::STATE_ERROR;
    }

    public function setStateProcessing(): ProductImport
    {
        $this->state = self::STATE_PROCESSING;
        return $this;
    }

    public function setStateSuccess(): ProductImport
    {
        $this->state = self::STATE_SUCCESS;
        $this->processed_at = now();
        return $this;
    }

    public function setStateError(): ProductImport
    {
        $this->state = self::STATE_ERROR;
        $this->processed_at = now();
        return $this;
    }

    public function setStateResult(bool $asSuccess): ProductImport
    {
        $this->state = $asSuccess ? self::STATE_SUCCESS : self::STATE_ERROR;
        $this->processed_at = now();
        return $this;
    }

    public function setErrors(array $errors): ProductImport
    {
        $this->errors = $errors ?: null;
        return $this;
    }

    public function getOptionValue(string $key): string
    {
        return $this->options[$key] ?? (self::getDefaultValueOptions())[$key] ?? '';
    }
}
