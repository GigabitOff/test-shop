<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

class ProductListLivewire extends Component
{
    public $checks;

    protected $cart_changed = false;

    public function mount()
    {
        //$this->checks[0] = 1;
        $ids = cart()->getCheckedIds()->toArray();
        $this->checks = array_combine($ids, $ids);
    }

    public function updateProductQuantity($product_id, $amount)
    {
        cart()->setQuantity($product_id, $amount);
        $this->cart_changed = true;
    }

    public function render()
    {
        if ($this->cart_changed){
            $this->emit('eventCartChanged');
        }
        return view('livewire.cart.product-list-livewire',[
            'products' => cart()->products(),
        ]);
    }

    public function removeProduct($product_id)
    {
        cart()->removeProducts($product_id);
        $this->cart_changed = true;
    }

    public function clearCart()
    {
        cart()->clear();
        $this->cart_changed = true;
    }

    public function updateChecks($product_id)
    {
        if (isset( $this->checks[$product_id])){
            unset($this->checks[$product_id]);
            cart()->checkProduct($product_id, false);
        } else {
            $this->checks[$product_id] = $product_id;
            cart()->checkProduct($product_id, true);
        }
        $this->cart_changed = true;
    }

    public function syncChecks($ids, $checked)
    {
        $this->checks = $checked ? array_combine($ids, $ids) : [];
        cart()->checkProductList($ids, $checked);

        $this->cart_changed = true;
    }
}
