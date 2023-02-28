<?php

namespace App\Http\Livewire\Customer\Cart;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithPerPage;
use App\Traits\WithExpandProduct;

class DeferredsGoods extends Component
{
    use WithPagination;
    use WithPerPage;
    use WithExpandProduct {
        expandProductAvailability as traitExpandProductAvailability;
    }

    protected string $perPageKey = 'deferredPerPage';
    protected int $perPage = 3;
    protected string $paginationTheme = 'paginator-buttons-cart';
    protected bool $revalidateTable = false;
    public float $cashbackUsed = 0;

    protected $listeners = ['eventDeferredsGoods' => 'setDeferredsGoods',
                            'eventDeleteGoods' => 'deleteDeferredsGoods',
                            'eventAddBusket' => 'addBusket',
                            'eventChangeQuantity' => 'changeQuantity',
                            'eventCheckAllChangedCheckbox' => 'checkAllChangedCheckbox',
                            ];

    public function render()
    {
        if ($this->revalidateTable) {

            $this->emit('eventRefreshPage');
            $this->emit('eventRefreshPrintCart');

        }
        $checkAll = $this->deferredsProductsCurrentUser()->where('checked', true)
            ->get()->map->checked->count();

        $this->dispatchBrowserEvent('refreshDerredsGoodsList');

        return view('livewire.customer.cart.deferreds-goods',
                        ['deferredsProducts' => $this->deferredsProducts(), 'checkAll'=> $checkAll]);
    }

    public function boot(){
        $this->user = auth()->user();
    }

    /** Set deferreds product to cart  */

    public function setDeferredsGoods($product_id, $quantity, $cartUuid, Product $product){

        if ($product->where('id', $product_id)->exists()){

            if(!$this->getCurrentProductDeferred($product_id)->exists()) {

                $product->deferredsGoods()->attach($product_id, [
                    'user_id' => $this->user->id,
                    'quantity' => $quantity,
                    'product_id' => $product_id
                ]);
            }
        }
        $this->revalidateTable = true;
        $this->removeCartProducts($cartUuid);

    }

    /** Remove product from cart  */

    protected function removeCartProducts($cartUuid){

        cart()->removeProducts($cartUuid);
        $this->emit('eventCartChanged');
        $this->revalidateTable = true;
    }

    /** Set pagination data  */

    public function setPerPage($value)
    {
        session()->put('perPage', $value);
        $this->perPage = $value;
        $this->resetPage();
        $this->revalidateTable = true;
    }

    /** Define product availability  */

    protected function expandProductAvailability($product)
    {

        $this->traitExpandProductAvailability($product);

        switch ($product->availabilityCss) {
            case 'not':
                $product->availabilityCss = '--status-6';
                break;
            case 'for-order':
                $product->availabilityCss = '--status-3';
                break;
            default:
                $product->availabilityCss = '--status-1';
        }
    }

    /** Get deferreds products */

    protected function deferredsProducts(){

        $productDeferreds = $this->deferredsProductsCurrentUser();

        $product =  Product::query()->select('id','articul', 'price_init', 'price_rrc',
                                    'price_sale', 'price_sale_show', 'price_purchase',
                                    'price_wholesale', 'price_retail', 'price_min_margin',
                                    'slug', 'on_backorder','availability', 'price_retail')
                                    ->whereIn('id', $productDeferreds
                                    ->pluck('product_id'))
                                    ->with('images', 'translation')
                                    ->paginate($this->perPage, ['*'], $this->perPageKey);

        $this->addAttributeToProductDeferreds($product,$productDeferreds);

        return $product;

    }

    /** Add attribute to deferreds products */

    protected function addAttributeToProductDeferreds($product,$productDeferreds){

           $product->each(function (Product $products) use ($productDeferreds) {

               $products->quantity = $this->quantity($productDeferreds, $products->id);
               $products->cartCost = $products->price * $products->quantity;
               $products->cartPrice = $products->price;
               $this->expandProductAvailability($products);

           });
    }

    /** Get product by current user */

    protected function deferredsProductsCurrentUser(){

        return DB::table('product_deferreds')->where('user_id', $this->user->id);
    }

    /** Get quantity  */

    protected function quantity($productDeferreds,$products_id){

        foreach($productDeferreds->get() as $product)
            if($product->product_id == $products_id)
                $quantity = (int)$product->quantity;

        return $quantity;
    }

    /** Change quantity in products */

    public function changeQuantity($products_id, $quantity)
    {
        $this->getCurrentProductDeferred($products_id)
            ->update(['quantity' => $quantity]);
    }
    /** Delete products */

    public function deleteDeferredsGoods($product_id){

        $this->getCurrentProductDeferred($product_id)->delete();
    }

    /** Get current product for */

    protected function getCurrentProductDeferred($product_id){

        return   DB::table('product_deferreds')
                ->where('product_id', $product_id)
                ->where('user_id', $this->user->id);
    }

    /** Remove from deferreds products and add to the busket  */

    public function addBusket($product_id, $quantity){

        cart()->addProduct($product_id, $quantity);
        $this->emit('eventCartChanged');
        $this->revalidateTable = true;

        $this->deleteDeferredsGoods($product_id);
    }

    public function checkAllChangedCheckbox(bool $checked){

             $this->deferredsProductsCurrentUser()
                ->update(['checked' => $checked]);
    }
}