<?php

namespace App\Http\Livewire\Header;

use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchWidget extends Component
{
    // Лимиты для вывода товаров по точному и приближенному совпадению
    const EXACT_LIMIT = 10;
    const MATCH_LIMIT = 20;
    const MATCH_LIMIT_ONLY = 30;

    public string $searchText = '';
    public int $selectedCategoryId = 0;

    protected Collection $categories;
    protected Collection $productsMatch;
    protected Collection $productsExact;
    protected bool $isSearchTextUpdated = false;

    protected CategoryService $categoryService;

    public function boot()
    {
        $this->categoryService = new CategoryService();

        $this->categories = collect([]);
        $this->productsMatch = collect([]);
        $this->productsExact = collect([]);
    }

    public function render()
    {
        return view('livewire.header.search-widget', [
            'categories' => $this->categories,
        ]);
    }

    // Real search magic is going below
    public function updatedSearchText($value)
    {
        $this->searchText = trim($value);
        $this->isSearchTextUpdated = true;
        $this->revalidateCategories();
    }

    public function clearSearch()
    {
        $this->reset('searchText');
    }

    public function selectCategory(int $id = 0)
    {
        if ($this->categories->isNotEmpty()) {
            $this->selectedCategoryId = $this->categories->find($id) ?? 0;
        }
    }

    public function isSearchTextUpdated(): bool
    {
        return $this->isSearchTextUpdated;
    }

    public function isActiveCategory(Category $category): bool
    {
        return $this->selectedCategoryId === $category->id;
    }

    protected function revalidateCategories()
    {
        $this->categories = $this->getCategories();
        if ($this->categories->isNotEmpty()) {
            $this->selectedCategoryId = $this->categories->first()->id;

            $this->categories
                ->each(function (Category $category) {
                    $this->expandWithExactProducts($category);
                    $this->expandWithMatchProducts($category);
                    $this->expandWithRoutUrl($category);
                });
        }
    }

    protected function expandWithExactProducts(Category $category)
    {
        $category->productsExact = $this->getProducts(true, self::EXACT_LIMIT, $category->descendands);
        $category->productsExactCount = $this->getProductsCount(true, $category->descendands);
        $category->showExactMoreBtn = $category->productsExactCount > self::EXACT_LIMIT;
    }

    protected function expandWithMatchProducts(Category $category)
    {
        $limit = $category->productsExactCount > 0
            ? self::MATCH_LIMIT
            : self::MATCH_LIMIT_ONLY;

        $category->productsMatch = $this->getProducts(false, $limit, $category->descendands);
        $category->productsMatchCount = $this->getProductsCount(false, $category->descendands);
        $category->showMatchMoreBtn = $category->productsMatchCount > $limit;
    }

    protected function expandWithRoutUrl(Category $category)
    {
        $category->urlExactShowAll = route('catalog.show', [
            'category' => $category->slug,
            'search' => $this->searchText,
        ]);

        $category->urlMatchShowAll = route('catalog.show', [
            'category' => $category->slug,
            'search' => $this->searchText,
        ]);
    }

    /**
     * Т.к. требуется отдать только категории 1й и 2й глубины
     * Выполняем поиск с подменой.
     *
     * @return Collection
     */
    protected function getCategories(): Collection
    {
        if (!$this->searchText) {
            return collect([]);
        }

        $categoryIds =
            Category::query()
                ->with(['translations', 'images'])
                ->whereRelation('products', function ($q) {
                    $sub = $this->getProductQuery(false)->select('id')->toRawSql();
                    $q->whereInRaw('id', $sub);
                })
                ->pluck('id');

        if ($categoryIds->isEmpty()) {
            return $categoryIds;
        }

        /**
         * Делаем выборку всего дерева предков.
         * Группируем по исходной id категории
         * Выбираем родительскую категорию первой или второй глубины с укаанием исходной категории
         * Группируем по id родительской категории
         * Собираем список исходных id категорий для каждоц родительской
         * Возвращаем уникальный список id категорий в формате [parentId => allChild]
         */
        $ancestors = $this->categoryService->getAncestors($categoryIds->toArray())
            ->groupBy->starter
            ->map(function ($group) {
                $max = $group->max->deep;
                return (object) [
                    'id' => ($max === 1)
                        ? $group->first()->id
                        : $group->firstWhere('deep', $max - 1)->id,
                    'starter' => $group->first()->starter,
                ];
            })
            ->groupBy->id
            ->map(function ($group) {
                return [
                    'id' => $group->first()->id,
                    'starters' => $group->map->starter->toArray(),
                ];
            })
            ->keyBy('id')
            ->map->starters
            ->toArray();

        $categories = Category::query()
            ->withTranslation()
            ->with(['mainImage'])
            ->whereIn('id', array_keys($ancestors))
            ->take(20)
            ->get();

        $categories
            ->each(function (Category $category) use ($ancestors) {
                // сохраняем исходные категории
                $category->descendands = $ancestors[$category->id] ?? [];

                $this->expandCategoryImage($category);
            });

        return $categories;

    }

    protected function expandCategoryImage(Category $category)
    {
        $category->imageSrc =
            fallbackCategoryImageUrl($category->mainImage->fullUrl ?? '');
    }


    protected function getProductsCount(bool $exactMatch, array $categoryIds = []): int
    {
        return $this->getCategoriesProductQuery($exactMatch, $categoryIds)->count();
    }

    protected function getProducts(bool $exactMatch, int $limit = 10, array $categoryIds = []): Collection
    {
        return $this->getCategoriesProductQuery($exactMatch, $categoryIds)
            ->with(['translations', 'categories'])
            ->select(['id', 'slug'])
            ->take($limit)
            ->get();
    }

    protected function getCategoriesProductQuery(bool $exactMatch = false, array $categoryIds = []): Builder
    {
        return $this->getProductQuery($exactMatch)
            ->when($categoryIds, function ($q) use ($categoryIds) {
                $q->whereHas('categories', fn($q2) => $q2->whereIn('id', $categoryIds));
            });
    }

    protected function getProductQuery(bool $exactMatch = false): Builder
    {
        $search = $this->searchText;
        $value = $exactMatch ? $search : "%$search%";
        return Product::query()
            ->where(function ($q) use ($value) {
                $q->whereTranslationLike('name', $value)
                    ->orWhereTranslationLike('country', $value)
                    ->orWhere('articul', 'like', $value)
                    ->orWhere('articul_search', 'like', $value)
                    ->orWhere('brand_search', 'like', $value);
            });
    }

}
