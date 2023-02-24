<?php

namespace App\Http\Livewire\Menu;

use App\Models\Brand;
use App\Models\MenuCategory;
use App\Models\Page;
use App\Services\CategoryService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;


class MenuMainCatalogLivewire extends Component
{

    // Filled from caller component
    public Page $mainPage;

    public Collection $menuCategories;

    public function mount(CategoryService $service)
    {
        throw_unless($this->mainPage, new \Exception('Missing page instance.'));

        $this->menuCategories = MenuCategory::query()
            ->with('category', function ($q) {
                $q->withTranslation();
                $q->with(['children.translation']);
            })
            ->where('page_id', $this->mainPage->id)
            ->onlyActive()
//            ->limit(6)
            ->orderBy('order')
            ->get();

        $this->menuCategories->each(function (MenuCategory $menuCategory) use ($service) {
            if ($category = $menuCategory->category) {
                $childId = $service->getCategoryIdsWithChildren($category->id);
                $category->brands = $this->getCategoryBrands($childId);
            }
        });
    }

    protected function getCategoryBrands(array $categoryIds)
    {
        return Brand::query()
            ->withTranslation()
            ->with(['mainImage'])
            ->select('id')
            ->whereHas('products', function ($q) use ($categoryIds) {
                $q->whereHas('categories', function ($q1) use ($categoryIds) {
                    $q1->whereIn('id', $categoryIds);
                });
            })
            ->orderBy('order', 'ASC')
            ->get()
            ->each(function (Brand $brand) {
                $this->expandBrandWithImage($brand);
            });
    }

    public function render()
    {
        return view('livewire.menu.menu-main-catalog-livewire');
    }

    protected function expandBrandWithImage(Brand $brand)
    {
        $brand->imageSrc = fallbackBrandImageUrl($brand->image_full_url);
    }
}
