<?php

namespace App\Http\Livewire\Manager\Orders;

use Livewire\Component;

class CreateBlockOrderLivewire extends Component
{
    /** Флаг указывающий кто запустил изменение (table|slider) */
    protected string $source = '';

    protected $listeners = [
        'eventSetProduct',
        'eventRemoveProduct',
        'eventSetProductQuantity',
        'eventBulkOrderProductsUploaded',
    ];

    public function render()
    {
        $products = cart()->products();
        $products->load('images', 'translation');

        $this->dispatchBrowserEvent('cartQuantityUpdated', [
            'source' => $this->source,
            'products' => $products->keyBy('id')->map(function ($el) {
                return $el->cartQuantity;
            }),
        ]);

        $swiper = view('livewire.manager.orders.create-swiper-render', [
            'products' => $products,
        ]);

        $totals = [
            'weight' => $products->map(fn($el)=>$el->weight*$el->cartQuantity)->sum(),
            'volume' => $products->map(fn($el)=>$el->volume*$el->cartQuantity)->sum(),
        ];

        return view('livewire.manager.orders.create-block-order-livewire', [
            'products' => $products,
            'swiper' => $swiper,
            'totals' => $totals,
        ]);
    }

    public function eventSetProduct($payload)
    {
        if ($payload['quantity']) {
            cart()->addProduct($payload['product_id'], $payload['quantity']);
        } else {
            $this->removeCartProduct($payload['product_id']);
        }

        $this->emit('eventCartChanged');
    }

    public function eventRemoveProduct($uuid)
    {
        cart()->removeProducts($uuid);

        $this->emit('eventCartChanged');
    }

    public function eventSetProductQuantity($payload)
    {
        if (empty($payload['quantity'])) {
            $this->removeCartProduct($payload['product_id']);
        } else {
            cart()->setQuantity($payload['product_id'], $payload['quantity']);
        }

        $this->source = $payload['source'] ?? '';

        $this->emit('eventCartChanged');
    }

    public function eventBulkOrderProductsUploaded()
    {
        $this->emit('eventCartChanged');
    }

    protected function removeCartProduct($productId)
    {
        $product = cart()->products()
            ->where('id', $productId)
            ->whereNull('cartUniq')
            ->first();
        if ($product) {
            cart()->removeProducts($product->cartUuid);
        }
    }
}
