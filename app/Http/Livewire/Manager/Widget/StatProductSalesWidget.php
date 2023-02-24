<?php

namespace App\Http\Livewire\Manager\Widget;

use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;

class StatProductSalesWidget extends Component
{
    const KEY = 'product_sales_rating';

    public array $products = [];
    public array $forwards = [];

    public function mount()
    {
        $this->evaluateProducts();
        $this->evaluateForwards();
    }

    public function render()
    {
        return view('livewire.manager.widget.stat-product-sales-widget', []);
    }

    public function clearForwards()
    {
        $productIds = array_column($this->products, 'id');

        Setting::query()->updateOrInsert(
                ['key' => self::KEY],
                ['value' => implode(',', $productIds)]
            );

        $this->reset('forwards');
    }

    protected function evaluateProducts()
    {
        $this->products = Product::query()
            ->withTranslation()
            ->where('sales', '>', 0)
            ->select('id', 'articul', 'sales')
            ->orderBy('sales', 'desc')
            ->take(100)->get()
            ->each(fn($p) => $p->translatedName = $p->name)
            ->toArray();
    }

    protected function evaluateForwards()
    {
        $last = Setting::query()->where('key', self::KEY)->first();
        $oldest = explode(',', $last->value ?? '');

        $productIds = array_column($this->products, 'id');
        $this->forwards = array_diff($productIds, $oldest);
    }

}
