<?php

namespace App\Http\Livewire\Customer\Orders;

use App\Models\Product;
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
        $products = $this->prepareProducts();

        $this->dispatchBrowserEvent('cartQuantityUpdated', [
            'source' => $this->source,
            'products' => $products->keyBy('id')->map(function ($el) {
                return $el->cartQuantity;
            }),
        ]);

        $swiper = view('livewire.customer.orders.create-swiper-render', [
            'products' => $products,
        ]);

        return view('livewire.customer.orders.create-block-order-livewire', [
            'products' => $products,
            'swiper' => $swiper,
        ]);
    }

    public function clearCart()
    {
        cart()->clear();
        $this->emit('eventCartChanged');
    }

    public function eventSetProduct($payload)
    {
        if ($payload['quantity']) {
            cart()->addProduct($payload['product_id'], abs($payload['quantity']));
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
            cart()->setQuantity($payload['product_id'], abs($payload['quantity']));
        }

        $this->source = $payload['source'] ?? '';

        $this->emit('eventCartChanged');
    }

    public function eventBulkOrderProductsUploaded()
    {
        $this->emit('eventCartChanged');
    }

    protected function prepareProducts()
    {
        return cart()->products()
            ->each(function (Product $p) {
                $this->expandProductAvailable($p);
            });
    }

    protected function expandProductAvailable(Product $product)
    {
        switch (true){
            case $product->isAvailabilityInStock():
                $product->availabilityText = __('custom::site.availability_exist');
                break;
            case $product->isAvailabilitySmallStock():
                $product->availabilityText = __('custom::site.availability_small');
                break;
            default:
                $product->availabilityText = '';
        }
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
