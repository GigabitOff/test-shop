<?php

namespace App\Http\Livewire\Header;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartWidget extends Component
{
    public $user;
    protected $listeners = [
        'eventCartChanged',
        'eventDeferredsGoodsCatalog',
    ];


    public function boot()
    {
        $this->user = auth()->user();

    }

    public function render()
    {

        return view('livewire.header.cart-widget', [
            'quantity' => cart()->totalQuantity(),
            'cost' => cart()->totalCost(),
        ]);

    }

    public function eventCartChanged()
    {
        // просто переотрисовка
    }

    public function eventDeferredsGoodsCatalog($product_id, $quantity, Product $product)
    {

        if ($product->where('id', $product_id)->exists()) {

            if (!$this->getCurrentProductDeferred($product_id)->exists()) {

                $product->deferredsGoods()->attach($product_id, [
                    'user_id' => $this->user->id,
                    'quantity' => $quantity,
                    'product_id' => $product_id
                ]);
            }
        }

    }

    protected function getCurrentProductDeferred($product_id)
    {

        return   DB::table('product_deferreds')
        ->where('product_id', $product_id)
            ->where('user_id', $this->user->id);
    }


}
