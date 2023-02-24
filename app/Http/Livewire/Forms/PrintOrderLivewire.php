<?php

namespace App\Http\Livewire\Forms;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class PrintOrderLivewire extends Component
{

    public ?Order $order = null;
    public bool $printWithSale = true;
    public bool $updateFootableValues = false;

    protected bool $revalidateTable = false;

    protected $listeners = [
        'eventShowPrintOrder',
    ];

    public function render()
    {
        $products = $this->revalidateProducts();
        if ($this->updateFootableValues) {
            $this->dispatchBrowserEvent('mpo_updateFooTableValues', [
                'withSale' => $this->printWithSale,
                'withSaleText' => $this->printWithSale
                    ? __('custom::site.with_sale')
                    : __('custom::site.without_sale'),
                'products' => $products->keyBy('id')
                    ->map(function ($p) {
                        return [
                            'orderPrice' => formatMoney($p->orderPrice),
                            'orderCost' => formatMoney($p->orderCost),
                        ];
                    })
            ]);
        }

        $this->order->totalCost = $products->sum('orderCost');


        return view('livewire.forms.print-order-livewire', [
            'products' => $products,
        ]);
    }

    /** ========== Event Listeners ========== */

    public function eventShowPrintOrder($payload)
    {
        throw_if(!isset($payload['orderId']), new \Exception('Order id missing'));

        $orderId = (int)$payload['orderId'];

        if ($this->order || $this->order->id === $orderId) {
            $this->skipRender();
        } else {
            $this->order = Order::find($orderId);

            if (!$this->order) {
                $this->dispatchBrowserEvent('flashMessage', [
                    'title' => __('custom::site.print_order'),
                    'message' => __('custom::site.order_print_error'),
                    'state' => 'danger'
                ]);
                $this->skipRender();
            }

            $this->revalidateTable = true;
        }

        $this->startShowMe();
    }

    public function printWithSale()
    {
        $this->printWithSale = true;
        $this->updateFootableValues = true;
    }

    public function printWithoutSale()
    {
        $this->printWithSale = false;
        $this->updateFootableValues = true;
    }

    protected function revalidateProducts()
    {
        return $this->order
            ? $this->order->products
                ->each(function (Product $p) {
                    $p->orderPrice = $this->printWithSale
                        ? $p->pivot->price
                        : $p->price_init;
                    $p->orderQuantity = $p->pivot->quantity;
                    $p->orderCost = $p->orderPrice * $p->orderQuantity;
                })
            : [];
    }

    protected function startShowMe()
    {
        $this->dispatchBrowserEvent('showModal', [
            'modalId' => 'm-print-order'
        ]);
    }

    public function isNeedRevalidateFootable(): bool
    {
        return $this->revalidateTable;
    }

}
