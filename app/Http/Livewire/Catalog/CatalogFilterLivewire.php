<?php

namespace App\Http\Livewire\Catalog;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;

class CatalogFilterLivewire extends Component
{
    // Uploaded from parent
    public ?Category $category = null;
    public int $filterId = 0;

    public int $parentCategoryId = 0;
    public array $selectedCategoryIds = []; //Заведомо выбранные категории

    public string $search = '';
    public array $filters = [];
    public array $filterSettings = [];   // Настройки фильтра получаемые из админки
    public array $filteredCategories = [];  // Категории доступные для отображения в фильтре
    public array $enabledCategories = [];   // категории отображаемые с фильтре
    public array $filteredBrands = [];      // Бренды отображаемые с фильтре
    public array $filteredAttributes = [];
    public array $filteredRangePrice = [];
    protected ?Collection $cacheProductIds = null;
    protected bool $updatePriceRange = true;

    protected $queryString = ['search' => ['except' => ''], 'filters'];

    public function mount()
    {
        if ($this->category) {
            // Если это категория не корневая
            if ($this->category->parent_id) {
                // Тут может быть только категория 2й глубины
                $this->parentCategoryId = $this->category->parent_id;
                $this->selectedCategoryIds[] = $this->category->id;
            } else {
                $this->parentCategoryId = $this->category->id;
            }
        }

        $this->evaluateFilterSettings();

        if ($this->selectedCategoryIds) {
            collect($this->selectedCategoryIds)
                ->each(fn($el) => $this->filters['category_id'][$el] = $el);
        }
        $this->evaluateCategoriesInFilterList();
        $this->evaluateFilteredBrands();
    }

    public function render()
    {
        $this->evaluateAttributeValues();
        $this->evaluateRangePriceValues();
        $this->evaluateEnabledCategories();

        if ($this->updatePriceRange) {
            $this->dispatchBrowserEvent('updatePriceRangeSlider', ['values' => $this->filteredRangePrice]);
        }

        return view('livewire.catalog.catalog-filter-livewire');
    }

    public function updatedSearch($value)
    {
        $this->filters['search'] = trim($value);
        $this->sendEventFiltersUpdated();
    }

    protected function evaluateFilterSettings()
    {
        $filter = Filter::query()
            ->where('id', $this->filterId)
            ->whereStatus(true)
            ->with(['filterItems'])
            ->first();

        $this->filterSettings = $filter
            ? $filter->toArray()
            : [];
    }

    protected function evaluateRangePriceValues()
    {
        $settings = $this->getFilterAttributeSettings(0);
        if (!$settings['show']) {
            unset($this->filters['price_range']);
            return;
        }

        [$min, $max] = $this->getPriceRangeValues();

        [$from, $to] = $this->getUserRangePrice($min, $max);
        $from = min(max($from, $min), $max); // ограничиваем в пределах min-max
        $to = min(max($from, $to), $max); // ограничиваем в пределах from-max
        /* if ($to == $from){
             $from = $min;
             $to = $max;
         }*/
        $this->filteredRangePrice = [
            'key' => 'price-range',
            'label' => __('custom:site.price'),
            'min' => $min,
            'max' => $max,
            'from' => $from,
            'to' => $to,
        ];

        $this->checkUserRangePrice();
    }

    /**
     * Расспаковываем пользовательские значения фильтра цены
     * @param $min
     * @param $max
     * @return array [from, to]
     */
    protected function getUserRangePrice($min, $max): array
    {
        if (!empty($this->filters['price_range'])) {
            $prices = explode('-', $this->filters['price_range']);
        }

        return [
            floatval($prices[0] ?? $min),
            floatval($prices[1] ?? $max),
        ];
    }

    /**
     * Проверяет скорректированные пользовательские значения фильтра цены
     *
     * Если пользовательские значения равны граничным, удаляем элемент из строки запроса.
     * Иначе устанавливаем скорректированные.
     *
     * @return void
     */
    protected function checkUserRangePrice()
    {
        $leftBound = $this->filteredRangePrice['min'] === $this->filteredRangePrice['from'];
        $rightBound = $this->filteredRangePrice['max'] === $this->filteredRangePrice['to'];

        if ($leftBound && $rightBound) {
            unset($this->filters['price_range']);
        } else {
            $this->filters['price_range'] = implode('-', [
                $this->filteredRangePrice['from'],
                $this->filteredRangePrice['to'],
            ]);
        }
    }

    protected function evaluateCategoriesInFilterList()
    {
        $this->filteredCategories = Category::query()
            ->where('parent_id', $this->parentCategoryId)
            ->where('status', true)
            ->when($this->filterSettings, function ($q) {
                $q->where('filter_status', true);
            })
            ->orderBy('filter_order')
            ->withTranslation()
            ->select('id', 'filter_order')
            ->get()
            ->keyBy('id')
            ->map(function ($cat) {
                return [
                    'key' => $cat->id,
                    'label' => $cat->name,
                    'order' => $cat->filter_order,
                    'checked' => in_array($cat->id, $this->filters['category_id'] ?? []),
                ];
            })->toArray();

        $this->checkUserCategories();
    }

    /**
     * Удаляем из фильтра категории, которых нет в списке доступных
     *
     * @return void
     */
    protected function checkUserCategories()
    {
        if (!empty($this->filters['category_id'])) {
            foreach ($this->filters['category_id'] as $key => $filter) {
                if (!in_array($key, array_keys($this->filteredCategories))) {
                    unset($this->filters['category_id'][$key]);
                }
            }
        }
    }

    /**
     * Отфильтровываем список категорий оставляя только те,
     * в которых есть товары в любой глубине вложенности.
     *
     * @return void
     */
    protected function evaluateEnabledCategories()
    {
        $service = app()->make(CategoryService::class);

        $this->enabledCategories = collect($this->filteredCategories)
            ->filter(function ($el) use ($service) {
                $catIds = $service->getCategoryIdsWithChildren($el['key']);

                return Category::query()
                    ->whereIn('id', $catIds)
                    ->whereHas('products')
                    ->exists();
            })
            ->keyBy(fn($el) => "#{$el['key']}")
            ->sortBy('order')
            ->toArray();
    }

    protected function evaluateFilteredBrands()
    {
        $service = app()->make(CategoryService::class);
        $checkedCats = collect($this->filteredCategories)->filter->checked->map->key->toArray();
        if ($checkedCats){
            $catIds = $service->getCategoryIdsWithChildren($checkedCats);
        } elseif ($this->parentCategoryId){
            $catIds = $service->getCategoryIdsWithChildren($this->parentCategoryId);
        } else {
            $catIds = [];
        }

        $this->filteredBrands = Brand::query()
            ->withTranslation()
            ->where('status', true)
            ->when($catIds, function ($q) use($catIds){
                $q->whereHas('products', function ($q1) use($catIds) {
                        $q1->whereHas('categories', fn($q2) => $q2->whereIn('id', $catIds));
                });
            })
            ->when(!$catIds, fn($q) => $q->whereHas('products'))
            ->select('id')
            ->get()
            ->keyBy('id')
            ->map(function ($el) {
                return [
                    'key' => $el->id,
                    'label' => $el->title,
                    'checked' => in_array($el->id, $this->filters['brand_id'] ?? []),
                ];
            })->toArray();

        $this->checkUserBrands();
    }
    /**
     * Удаляем из фильтра бренды, которых нет в списке доступных
     *
     * @return void
     */
    protected function checkUserBrands()
    {
        if (!empty($this->filters['brand_id'])) {
            foreach ($this->filters['brand_id'] as $key => $filter) {
                if (!in_array($key, array_keys($this->filteredBrands))) {
                    unset($this->filters['brand_id'][$key]);
                }
            }
        }
    }


    protected function evaluateAttributeValues()
    {
        if (!$this->filterSettings) {
            return;
        }

        $productIds = $this->getFilteredProductIds();

        $attributes = Attribute::query()
            ->whereHas('attributeValues', function ($q) use ($productIds) {
                $q->whereHas('product', fn($q2) => $q2->whereIn('id', $productIds));
            })
            ->with('attributeValues', function ($q) use ($productIds) {
                $q->withTranslation()
                    ->whereHas('product', fn($q) => $q->whereIn('id', $productIds));
            })
            ->get();

        $this->filteredAttributes = $attributes
            ->each(fn($at) => $at->settings = $this->getFilterAttributeSettings($at->id))
            ->filter(fn($at) => $at->settings['show'])
            ->map(function ($attr) {
                $attributeValues = $attr->attributeValues->unique('slug');
                $showTitle = (bool)data_get($attr->settings, 'show_title', false);
                $valuesOrderType = data_get($attr->settings, 'order_type', '');
                return [
                    'key' => $attr->id,
                    'order' => data_get($attr->settings, 'order', 0),
                    'collapsed' => !data_get($attr->settings, 'expanded_list', false),
                    'searchable' => (bool)data_get($attr->settings, 'search', false),
                    'type' => data_get($attr->settings, 'show_type', 'checkbox'),
                    'show_title' => $showTitle,
                    'label' => $showTitle ? $attr->name : '',
                    'values' => $attributeValues
                        ->map(function ($av) use ($attr) {
                            return [
                                'key' => $av->slug,
                                'label' => $av->name,
                                'checked' => in_array($av->slug, $this->filters["attr_{$attr->id}"] ?? []),
                            ];
                        })
                        ->when($valuesOrderType,
                            function (Collection $collection) use($valuesOrderType){
                                [$byDesc, $byNumeric] = $this->getAttributeValueOrderSettings($valuesOrderType);
                                $flags = $byNumeric ? SORT_NUMERIC : SORT_NATURAL;
                                return $byDesc
                                    ? $collection->sortByDesc('label', $flags)
                                    : $collection->sortBy('label', $flags);
                        })
                        ->values()
                        ->toArray(),
                ];
            })
            ->each(function ($el) {
                // Проверка типа отображения на валидность
                $valid = ['radio', 'checkbox', 'checkbox_icon', 'icon', 'select'];
                if (!in_array($el['type'], $valid)){
                    $el['type'] = 'checkbox';
                }
            })
            ->sortBy->order
            ->values()
            ->toArray();
    }

    protected function getAttributeValueOrderSettings(string $sortType): array
    {
        $byDesc = Str::contains(strtolower($sortType), 'desc');
        $byNumeric = Str::contains(strtolower($sortType), 'numeric');

        return [ $byDesc, $byNumeric ];
    }


    protected function getFilteredProductIds(): Collection
    {
        if (is_null($this->cacheProductIds)) {
            $query = Product::query()
//                ->withoutGlobalScope('withPrices')
                ->tap(fn($q) => $this->applyFilteredCategories($q))
                ->tap(fn($q) => $this->applyFilteredAttributes($q))
                ->tap(fn($q) => $this->applyFilteredBrands($q));

            $this->cacheProductIds = $query->pluck('id');
        }

        return $this->cacheProductIds;
    }

    protected function applyFilteredCategories(Builder $query)
    {
        $service = app()->make(CategoryService::class);

        $filteredCategories = collect($this->filteredCategories)->filter->checked->toArray();

        $categoryIds = $filteredCategories
            ? $service->getCategoryIdsWithChildren(array_column($filteredCategories, 'key'))
            : $service->getCategoryIdsWithChildren($this->parentCategoryId);

        $query->when($categoryIds, function ($q) use ($categoryIds) {
            return $q->whereHas('categories', fn($q1) => $q1->whereIn('id', $categoryIds));
        });
    }

    protected function applyFilteredBrands(Builder $query)
    {
        $checked = collect($this->filteredBrands)->filter->checked->map->key->toArray();

        if ($checked){
            $query->whereHas('brand', fn($q1) => $q1->whereIn('id', $checked));
        }
    }

    protected function applyFilteredAttributes(Builder $query)
    {
        $attrValues = [];
        foreach ($this->filters as $key => $filter) {
            if (!Str::startsWith($key, 'attr_')) {
                continue;
            }

            $attrValues = array_merge($attrValues, $filter);
        }

        if ($attrValues) {
            $query->whereHas('attributeValues', function ($q) use ($attrValues) {
                $q->whereHas('translations', fn($q) => $q->whereIn('slug', $attrValues));
            });
        }
    }

    protected function getPriceRangeValues(): array
    {
        $productIds = $this->getFilteredProductIds();
        // ToDo: Сделать оптимизацию. Определение мин/макс в один запрос.
//        $query = Product::query()->whereIn('id', $productIds);
//        $sub = $query->toSql();
//        $bindings = $query->getBindings();
//        $prices = DB::select("
//            SELECT MIN(price_init) as min_price, MAX(price_init) as max_price
//            FROM ({$sub}) as prdp
//            WHERE 1;
//        ", $bindings);
//
//        return [
//            'min' => $prices[0]->min_price ?? 0,
//            'max' => $prices[0]->max_price ?? 0,
//        ];

        // дефолтный вариант определения min/max
        $min = Product::query()->whereIn('id', $productIds)->min(Product::getPriceField());
        $max = Product::query()->whereIn('id', $productIds)->max(Product::getPriceField());
        return [
            floatval(floor($min)),
            floatval(ceil($max)),
        ];
    }

    protected function getFilterAttributeSettings(int $attrId): array
    {
        if (!empty($this->filterSettings['filter_items'])) {
            $settings = collect($this->filterSettings['filter_items'])
                ->where('attribute_id', $attrId)
                ->first();
        }
        $canShow = $settings['status'] ?? true;
//        $userCanView = !(!auth()->check() && ($settings['registered_user'] ?? false));
        $userCanView = !($settings['registered_user'] ?? false) || auth()->check();
        return array_merge(
            $settings ?? [],
            ['show' => $canShow && $userCanView],
        );
    }

    public function setFilterItemData($filter, $value = '', $checked = true, $unique = false)
    {
        if ('price_range' === $filter) {
            $this->filters[$filter] = implode('-', $value);
            $this->updatePriceRange = false;
        } else {
            if (!$value){
                unset($this->filters[$filter]);
            } else {
                if ($unique){
                    unset($this->filters[$filter]);
                }
                if ($checked) {
                    $this->filters[$filter][$value] = $value;
                } else {
                    unset($this->filters[$filter][$value]);
                }
            }
        }

        // Обновляем состояния checked для фильтра категорий
        if ('category_id' === $filter) {
            $this->setCheckedCategoryFilter();
            // Обновляем список брендов по выбранным категориям
            $this->evaluateFilteredBrands();
            $this->tryRedirectRootCategory($value);
        }

        // Обновляем состояния checked для фильтра по брендам
        if ('brand_id' === $filter) {
            $this->setCheckedBrandFilter();
        }

        // Обновляем состояния checked для фильтров атрибутов
        if (Str::startsWith($filter, 'attr_')) {
            $this->setCheckedAttributesFilters();
        }

        $this->sendEventFiltersUpdated();
    }


    public function resetFilters(string $filter = '')
    {
        $this->reset(['filters', 'search']);
        $this->setCheckedCategoryFilter();
        $this->setCheckedBrandFilter();
        $this->setCheckedAttributesFilters();
        $this->sendEventFiltersUpdated();
    }

    protected function setCheckedCategoryFilter()
    {
        $this->setCheckedFilterItems($this->filteredCategories, $this->filters['category_id'] ?? []);
    }

    protected function setCheckedBrandFilter()
    {
        $this->setCheckedFilterItems($this->filteredBrands, $this->filters['brand_id'] ?? []);
    }

    protected function setCheckedAttributesFilters()
    {
        foreach ($this->filteredAttributes as &$attrFilter) {
            $this->setCheckedFilterItems(
                $attrFilter['values'],
                $this->filters["attr_{$attrFilter['key']}"] ?? []
            );
        }
    }

    protected function setCheckedFilterItems(array &$filter, array $checkedList = [])
    {
        foreach ($filter as &$item) {
            $item['checked'] = in_array($item['key'], $checkedList);
        }
    }

    protected function sendEventFiltersUpdated()
    {
        $this->emit('eventFiltersUpdated', $this->filters);
    }

    protected function tryRedirectRootCategory($categoryId)
    {
        $category = Category::query()
            ->onlyRoot()
            ->where('id', (int)$categoryId)
            ->first();

        if ($category) {
            $this->redirectRoute('catalog.show', $category->slug);
        }
    }
}
