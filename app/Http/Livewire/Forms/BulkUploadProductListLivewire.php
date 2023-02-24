<?php

namespace App\Http\Livewire\Forms;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Collection;

class BulkUploadProductListLivewire extends Component
{
    public array $list = [];

    protected $listeners = [
        'eventParseDataShow'
    ];

    public function render()
    {
        $this->dispatchBrowserEvent('updateBulkFooData');

        $table = view('livewire.forms.bulk-upload-footable-render-livewire', [
            'items' => $this->list,
        ])->render();

        return view('livewire.forms.bulk-upload-product-list-livewire', [
            'table' => $table,
        ]);
    }

    public function dataCorrect()
    {
        $rows = collect($this->list)
            ->map(function($item){
                return trim(implode(' ', [
                    $item['sku'],
                    $item['qty'],
                    ($item['notFounded'] ? '----Err' : '')
                ]));
            })->join(PHP_EOL);
        $this->emit('eventParseDataCorrection', $rows);
        $this->skipRender();
    }

    public function addProductsToCart()
    {
        if (!$this->list) {
            $this->dispatchBrowserEvent(
                'flashMessage',
                [
                    'title' => __('custom::site.bulk_uploading'),
                    'message' => __('custom::site.uploading_products_not_found'),
                    'state' => 'warning'
                ]
            );
            return;
        }

        $pack = collect($this->list)
            ->filter(fn($i) => $i['id'])    // отфильтровываем пустые id
            ->filter(fn($i) => $i['qty'])   // отфильтровываем количество 0
            ->keyBy('id')
            ->map(function ($item) {
                return [
                    'quantity' => $item['qty'],
                    'checked' => true,
                ];
            })->toArray();

        cart()->checkProductList(cart()->productIds()->toArray(), false);
        // Did not use cart service for performance
        $cart = auth()->user()->cart()->firstOrCreate();
        $cart->products()->syncWithoutDetaching($pack);

        $this->emit('eventBulkOrderProductsUploaded');

        $this->dispatchBrowserEvent(
            'flashMessage',
            [
                'title' => __('custom::site.bulk_uploading'),
                'message' => __('custom::site.uploading_products_success'),
                'state' => 'success'
            ]
        );
    }

    public function eventParseDataShow()
    {
        $this->dispatchBrowserEvent('bulkUploaderViewerShow');

        $list = collect(session()->get('importOrderProducts', []));

        $parsed = $list->map(function ($row) {
            $items = preg_split('/\s/', $row);
            return [
                'sku' => trim($items[0] ?? '--'),
                'qty' => (int)trim($items[1] ?? '0')
            ];
        });
        $this->parseProducts($parsed);
    }

    protected function parseProducts(Collection $list)
    {
        $skus = $list->map->sku;

        $products = Product::query()
            ->whereIn('articul', $skus)
            ->withTranslation()
            ->select(['id', 'articul', 'availability'])
            ->get()->keyBy('articul');

        $this->list = $list
            ->map(function ($item) use ($products) {
                $product = $products->get($item['sku']);
                $item['id'] = ($product->id ?? 0);
                $item['notFounded'] = !$item['id'];
                $item['outOfStock'] = !($product && $product->availability);
                $item['name'] = $product->name ?? '';
                $item['status'] = $product
                    ? ($product->availability
                        ? __('custom::site.availability_exist')
                        : __('custom::site.availability_waiting'))
                    : __('custom::site.product_not_found');
                return $item;
            })
            ->toArray();
    }


}
