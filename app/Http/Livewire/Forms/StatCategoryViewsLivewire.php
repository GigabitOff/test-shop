<?php

namespace App\Http\Livewire\Forms;

use App\Models\CategoryVisit;
use Illuminate\Support\Collection;
use Livewire\Component;

class StatCategoryViewsLivewire extends Component
{
//    const KEY = 'product_sales_rating';

    public bool $isUploadLazyContent = false;

    public function render()
    {
        $views = $this->revalidateViews();
//        $forwards = $this->forwards($products->pluck('id')->toArray());

        return view('livewire.forms.stat-category-views-livewire', [
            'views' => $views,
//            'forwards' => $forwards,
        ]);
    }

    public function uploadLazyContent($payload = null)
    {
        $this->isUploadLazyContent = true;
    }

    protected function revalidateViews(): Collection
    {
        return $this->isUploadLazyContent
            ? CategoryVisit::query()
                ->with('category', function ($q) {
                    $q->withTranslation()
                        ->select('id', 'slug');
                })
                ->orderBy('quantity', 'desc')
                ->take(100)->get()
                ->each(function ($el) {
                    $el->categoryId = $el->category->id;
                    $el->categorySlug = $el->category->slug;
                    $el->categoryName = $el->category->name;
                })

            :
            collect([]);
    }

//    protected function forwards(array $productIds): array
//    {
//        $last = Setting::query()->where('key', self::KEY)->firstOrNew();
//        $oldest = explode(',', $last->value ?? '');
//
//        if (implode(',', $productIds) !== implode(',', $oldest)){
//            $last->json = $productIds;
//            $last->key = self::KEY;
//            $last->save();
//        }
//
//        return array_diff($productIds, $oldest);
//    }

}
