<?php

namespace App\Http\Livewire\MainPage;

use App\Models\Product;
use App\Models\ProductVisit;
use App\Traits\WithExpandProduct;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ViewedSectionLivewire extends Component
{
    use WithExpandProduct;

    public function render()
    {
        return view('livewire.main-page.viewed-section-livewire', [
            'products' => $this->getRecentlyViewedProducts(),
        ]);
    }

    /**
     * Отбираются просмотренные товары по текущему клиенту,
     * сортиируются по последним просмотренным
     * ограничивая 40 товарав.
     *
     * @return Collection
     */
    public function getRecentlyViewedProducts(): Collection
    {
        $userId = auth()->id();
        $userIp = request()->ip();

        $sub = ProductVisit::query()
            ->select(['product_id as visits_product_id', DB::raw('MAX(`updated_at`) as last_visit_at')])
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('ip', $userIp))
            ->groupBy('product_id');

        $products = ($userId || $userIp)
            ? Product::query()
                ->rightJoinSub($sub, 'v', 'v.visits_product_id', '=', 'products.id')
                ->with(['allVariations', 'mainImage', 'translations', 'brand.images'])
                ->with(['attributeValues.translations', 'attributeValues.attribute.translations'])
                ->orderByDesc('last_visit_at')
                ->take(40)
                ->get()
            : collect();

        return $products;
    }

}
