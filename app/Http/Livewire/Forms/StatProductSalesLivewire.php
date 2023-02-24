<?php

namespace App\Http\Livewire\Forms;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Collection;
use Livewire\Component;

class StatProductSalesLivewire extends Component
{
//    const KEY = 'product_sales_rating';

    public bool $isUploadLazyContent = false;

    public function render()
    {
        $products = $this->revalidateProducts();
//        $forwards = $this->forwards($products->pluck('id')->toArray());

        return view('livewire.forms.stat-product-sales-livewire',[
            'products' => $products,
//            'forwards' => $forwards,
        ]);
    }

    public function uploadLazyContent($payload = null)
    {
        $this->isUploadLazyContent = true;
    }

    protected function revalidateProducts(): Collection
    {
        return $this->isUploadLazyContent
            ? Product::query()
                ->withTranslation()
                ->where('sales', '>', 0)
                ->select('id', 'articul', 'sales')
                ->orderBy('sales', 'desc')
                ->take(100)->get()

            : collect([]);
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
