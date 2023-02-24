<?php

namespace App\Http\Livewire\Pages\Brands;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Brand;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesSectionLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    // Filled from source component
    public Brand $brand;

    public int $perPageDefault = 8;
    public string $perPageKey = 'brandCatalogPerPage';
    protected string $paginationTheme = 'paginator-front';

    protected CategoryService $categoryService;

    public function boot()
    {
        $this->categoryService = new CategoryService();
    }
    public function render()
    {
        $categories = $this->evaluateCategories();
        return view('livewire.pages.brands.categories-section-livewire', compact('categories'));
    }

    /**
     * Выполняет выборку категорий товаров привязанных к текущему бренду.
     *
     * Т.к. в фильтре отображаем только первые 2 глубины, то для каждой категории
     * надо найти родителя первой или второй глубины.
     *
     * @return void
     */
    protected function evaluateCategories(): LengthAwarePaginator
    {
        $categoryIds =
            Category::query()
                ->whereHas('products', function ($q) {
                    $q->whereRelation('brand', 'id', '=', $this->brand->id);
                })
                ->pluck('id');

        /**
         * Делаем выборку всего дерева предков.
         * Группируем по исходной id категории
         * Выбираем родительскую категорию первой или второй глубины
         * Возвращаем уникальный список id категорий
         */
        $ancestors = $this->categoryService->getAncestors($categoryIds->toArray())
            ->groupBy->starter
            ->map(function ($group) {
                $max = $group->max->deep;
                if ($max === 1){
                    return $group->first()->id;
                }   else {
                    return $group->firstWhere('deep', $max-1)->id;
                }
            })
            ->unique()
            ->values();

        $categories = Category::query()
            ->withTranslation()
            ->with(['mainImage'])
            ->whereIn('id', $ancestors)
            ->paginate($this->getPerPageValue());

        $categories->getCollection()
                ->each(function (Category $category){
                    $this->expandCategoryImage($category);
                });

        return $categories;
    }

    protected function expandCategoryImage(Category $category)
    {
        $category->imageSrc =
            fallbackCategoryImageUrl($category->mainImage->fullUrl ?? '');
    }
}
