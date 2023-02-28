<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Collection;

class PrintCartOrderLivewire extends Component
{
    protected ?Collection $products = null;
    public bool $printWithSale = true;
    public bool $updateFootableValues = false;

    protected $listeners = [
        'eventRefreshPrintCart'
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
                            'sumPrice' => formatMoney($p->cartPrice * $p->cartQuantity),
                            'sumRetail' => formatMoney($p->price_retail * $p->cartQuantity),
                        ];
                    })
            ]);
        }

        $totalSumPrice = $this->printWithSale ? 'sumPrice' : 'sumRetail';

        $totalCost = $this->totalSumBySpecialPriceField($products,$totalSumPrice);

        return view('livewire.forms.print-cart-order-livewire',
            compact('products', 'totalCost'));
    }

    /** Return total sum by fields */

    protected function totalSumBySpecialPriceField($products,$field){

        return formatMoney($products->sum($field));
    }

    protected function expandProductStatus(Product $product)
    {
        if ($product->on_backorder){
            $product->statusText = __('custom::site.on_backorder');
            $product->availabilityCss = '--status-3';
        } else {
            if ($product->stock > 0) {
                $product->statusText = __('custom::site.availability_exist');
                $product->availabilityCss = '--status-1';
            }else{
                $product->statusText = __('custom::site.availability_absent');
                $product->availabilityCss = '--status-6';
            }
        }
    }

    public function eventRefreshPrintCart(){

        $this->updateFootableValues = true;

    }

    protected function revalidateProducts()
    {
        if (!$this->products || $force) {
            $products = cart()->products();
            $products->load('translation');

            $this->products = $products
                ->each(function (Product $product) {
                    $this->expandProductPrice($product);
                    $this->expandSum($product);
                    $this->expandProductStatus($product);
                });
        }

        return  $this->products;

    }
    protected function expandProductPrice(Product $product)
    {
        $product->cartPrice = $this->printWithSale
                              ? $product->price
                              : $product->price_init;
    }

    /** added fields to the object product */

    protected function expandSum(Product $product)
    {

        $product->sumPrice = formatMoney($product->cartPrice
                             * $product->cartQuantity);

        $product->sumRetail = formatMoney($product->price_retail
                              * $product->cartQuantity);
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
}
