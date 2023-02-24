<?php

namespace App\Http\Livewire\Catalog;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class CatalogBodyLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    const ORDER_NONE = 'none';
    const ORDER_CHEAP = 'cheap';
    const ORDER_EXPENSIVE = 'expensive';
    const ORDER_POPULAR = 'popular';
    const ORDER_NOVELTY = 'novelties';
    const ORDER_ACTIONS = 'actions';
    const ORDER_RATING = 'rating';
    const ORDER_SALE = 'sale';
    const ORDER_MARKDOWN = 'markdown';


    // Uploaded from parent
    public ?Category $category = null;
    public int $parentCategoryId = 0;
    public array $selectedCategoryIds = [];

    public string $order = self::ORDER_CHEAP;

    public array $filters = [];
    public string $search = '';

    protected $queryString = [
        'order' => ['except' => 'cheap'],
        'page' => ['except' => 1],
        'search' => ['except' => ''],
        'filters',
    ];

    protected $listeners = [
        'eventFiltersUpdated'
    ];

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
    }

    public function render()
    {
        $products =  $this->revalidateProducts();

        return view('livewire.catalog.catalog-body-livewire', ['data_paginate' => $products]);
    }

    public function revalidateProducts(): LengthAwarePaginator
    {

        $query = Product::query()
            ->orderByDesc('can_be_sold')
            ->with(['brands'=>function($q){
                $q->select('image_small');
             }])
            ->with(['images' => function ($query) {
                $query->orderBy('main', 'desc');
            }])
            ->with(['translations', 'brand.images', 'allVariations'])
            ->with(['attributeValues.translations', 'attributeValues.attribute.translations']);

        $this->applyFilteredCategories($query);
        $this->applyFilteredBrands($query);
        $this->applyFilteredAttributes($query);
        $this->applyFilteredSearch($query);
        $this->applyFilteredPriceRange($query);
        $this->applyFilteredChangeActions($query);
        $this->applyFilteredProductRating($query);
        $this->applySortOrder($query);

        return $query->paginate($this->getPerPageValue());
    }

    protected function applyFilteredCategories(Builder $query)
    {
        $service = app()->make(CategoryService::class);

        $filteredCategoryIds = array_values($this->filters['category_id'] ?? []);

        $categoryIds =  $filteredCategoryIds
            ? $service->getCategoryIdsWithChildren($filteredCategoryIds)
            : $service->getCategoryIdsWithChildren($this->parentCategoryId);

        $query->when($categoryIds, function ($q) use($categoryIds) {
            return $q->whereHas('categories', fn($q1) => $q1->whereIn('id', $categoryIds));
        });
    }

    protected function applyFilteredBrands (Builder $query)
    {
        $filteredBrandIds = array_values($this->filters['brand_id'] ?? []);

        $query->when($filteredBrandIds, function ($q) use($filteredBrandIds) {
            return $q->whereHas('brand', fn($q1) => $q1->whereIn('brand_id', $filteredBrandIds));
        });
    }

    protected function applyFilteredAttributes(Builder $query)
    {
        $attrValues = [];
        foreach ($this->filters as $key => $filter){
            if (!Str::startsWith($key, 'attr_')){
                continue;
            }
            $attrValues = array_merge($attrValues, $filter);
        }

        if ($attrValues){
            $query->whereHas('attributeValues', function ($q) use($attrValues){
                $q->whereHas('translations', fn($q) => $q->whereIn('slug', $attrValues));
            });
        }
    }

    protected function applyFilteredSearch(Builder $query)
    {
        if ($this->search) {
            $query->where(function($q){
                $q->whereTranslationLike('name', "%$this->search%")
                    ->orWhere('articul', 'like', "%$this->search%")
                    ->orWhere('articul_search', 'like', "%$this->search%");
            });
        }
    }

    protected function applyFilteredPriceRange(Builder $query)
    {
        if (!empty($this->filters['price_range'])){
            $prices = explode('-', $this->filters['price_range']);
            $from = floatval($prices[0] ?? false);
            $to = floatval($prices[1] ?? false);

            if ($from){
                $query->where(Product::getPriceField(), '>=', $from);
            }

            if ($to){
                $query->where(Product::getPriceField(), '<=', $to);
            }
        }
    }

    protected function applySortOrder(Builder $query)
    {
        //$query->orderBy('in_stock', 'desc');
        switch (true){
            case $this->isOrderCheap():
                $query->orderBy(Product::getPriceField());
                break;
            case $this->isOrderExpensive():
                $query->orderByDesc(Product::getPriceField());
                break;
            case $this->isOrderPopular():
                $query->orderByDesc('popular');
                break;
            case $this->isOrderNovelty():
                $query->orderByDesc('new');
                break;
            case $this->isOrderActions():
                $query->whereHas('actions');
                break;
            case $this->isOrderRating():
                $this->Rating($query);
                break;
            case $this->isOrderSale():
                $query->where('price_sale_show', true);
                break;
            case $this->isOrderMarkdown():
                $query->where('markdown', true);
                break;
            default:
        }
    }

    protected function applyFilteredChangeActions(Builder $query)
    {
        if ($this->isOrderActions()) {

            $newQuery = $query->clone();
            $this->applySortOrder($newQuery);

            if ($newQuery->count() == 0) {
                $this->setOrderCheap();
            }

        }
    }

    protected function applyFilteredProductRating(Builder $query)
    {
        if ($this->isOrderRating()) {

            $ratingQuery = $query->clone();
            $this->applySortOrder($ratingQuery);

            if ($ratingQuery->count() == 0) {
                $this->setOrderCheap();
            }
        }
    }


    protected function Rating(Builder $query)
    {

     $query->join('product_visits as visits', 'visits.product_id', '=', 'products.id')
                ->selectRaw('products.id, products.slug, products.price_init,
                products.availability, products.articul, sum(visits.quantity) as quantity')
                ->whereColumn('visits.product_id', 'products.id')
                ->groupBy('visits.product_id')
                ->orderBy('quantity', 'desc')->get();
    }

    public function eventFiltersUpdated($payload)
    {
        $this->filters = (array)$payload;
        $this->search = $this->filters['search'] ?? '';


        $this->resetPage();
    }

    public function setOrderCheap()
    {
        $this->order = self::ORDER_CHEAP;
    }

    public function setOrderExpensive()
    {
        $this->order = self::ORDER_EXPENSIVE;
    }

    public function setOrderPopular()
    {
        $this->order = self::ORDER_POPULAR;
    }

    public function setOrderNovelty()
    {
        $this->order = self::ORDER_NOVELTY;
    }

    public function setOrderActions()
    {
        $this->order = self::ORDER_ACTIONS;
    }
    public function setOrderRating()
    {
        $this->order = self::ORDER_RATING;
    }
    public function setOrderSale()
    {
        $this->order = self::ORDER_SALE;
    }

    public function setOrderMarkdown()
    {
        $this->order = self::ORDER_MARKDOWN;
    }

    public function isOrderCheap(): bool
    {
        return $this->order === self::ORDER_CHEAP;
    }

    public function isOrderExpensive(): bool
    {
        return $this->order === self::ORDER_EXPENSIVE;
    }

    public function isOrderPopular(): bool
    {
        return $this->order === self::ORDER_POPULAR;
    }

    public function isOrderNovelty(): bool
    {
        return $this->order === self::ORDER_NOVELTY;
    }

    public function isOrderActions(): bool
    {
        return $this->order === self::ORDER_ACTIONS;
    }

    public function isOrderRating(): bool
    {
        return $this->order === self::ORDER_RATING;
    }

    public function isOrderSale(): bool
    {
        return $this->order === self::ORDER_SALE;
    }

    public function isOrderMarkdown(): bool
    {
        return $this->order === self::ORDER_MARKDOWN;
    }

}
