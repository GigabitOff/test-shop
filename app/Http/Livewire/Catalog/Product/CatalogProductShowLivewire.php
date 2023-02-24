<?php

namespace App\Http\Livewire\Catalog\Product;

use App\Models\PersonalOffer;
use App\Models\User;
use App\Services\UsersService;
use Livewire\Component;

class CatalogProductShowLivewire extends Component
{
    public $item_id, //category_id
        $products,
        $data,
        $perPage = 5,
        $search = '',

        /** @var User */
        $user;

    public array $offers = [];  //  PersonalOffers

    protected $listeners = [
        'eventAddProductToCart',
    ];

    public function mount()
    {
        $this->user = auth()->user();
        $this->revalidatePersonalOffers();
    }

    public function render()
    {
        if (isset($this->products) and count($this->products) > 0) {
            $this->products->load(['mainImage', 'images', 'translations']);
        }
        return view('livewire.catalog.product.catalog-product-show-livewire');
    }

    public function eventAddProductToCart($productId, $quantity)
    {
        // сперва добавляем товары персонального предложения, позже обычные
        if ($offer = $this->getPersonalOffer($productId)){
            $offerProductId = $offer->selfProduct()->pluck('id')->first() ?? 0;

            $inCartQty = cart()->getQuantity($offerProductId);
            $maxToAdd = $offer['quantity'] - $inCartQty;
            $maxToAdd = ($maxToAdd < 0) ? 0 : $maxToAdd;
            $canAdd = ($maxToAdd < $quantity) ? $maxToAdd : $quantity;

            if ($offerProductId) {
                cart()->addProduct($offerProductId, $canAdd);
                $quantity -= $canAdd;
            }
        }
        if ($quantity) {
            cart()->addProduct($productId, $quantity);
        }

        $this->emit('eventCartChanged');
    }

    protected function getPersonalOffer($productId)
    {
        return !empty($this->offers[$productId])
            ? PersonalOffer::find($this->offers[$productId]['id'])
            : null;
    }

    protected function revalidatePersonalOffers()
    {
        /** @var UsersService $service */
        $service = app(UsersService::class);

        $query = $service->customerPersonalOffersQuery($this->user);

        $this->offers =
            $query->with('products')->get()
                ->each(function (PersonalOffer $offer) {
                    $offer->productId =  0;
                    $offer->productPrice = 0;
                    if ($product = $offer->products->first()) {
                        $offer->productId = $product->id;
                        $offer->productPrice = $offer->price ?? $product->pivot->price;
                    }
                })
                ->keyBy('productId')
                ->toArray();
    }
}
