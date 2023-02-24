<?php

namespace App\Modules\Favourites;

use App\Models\Product;
use App\Modules\Favourites\Contracts\FavouritesContract;

class FavouritesBySession implements FavouritesContract
{
    /**
     * Favourite session structure
     * [
     *   products => [
     *     [ id => 0],
     *   ]
     * ]
     */

    protected $sessionKey = 'favourites';
    protected $products;
    protected $ids;

    public function __construct()
    {
        $favourites = collect(session()->get($this->sessionKey, []));
        if ($favourites->has('products')) {
            $sessionProducts = collect($favourites['products']);

            $this->ids = $sessionProducts->isNotEmpty()
                ? Product::query()->whereIn('id', $sessionProducts->map->id)->pluck('id')
                : collect([]);
        } else {
            $this->ids = collect([]);
            $this->updateSession();
        }
    }

    public function products()
    {
        /**
         * С большинстве случаев нет необходимости выгружать все товары
         * Поэтому делаем это только по запросу.
         */
        if (!$this->products) {
            $this->products = Product::query()->whereIn('id', $this->ids)->get();
        }
        return $this->products;
    }

    public function productIds()
    {
        return $this->ids;
    }

    public function count()
    {
        return $this->ids->count();
    }

    public function clear()
    {
        $this->ids = collect([]);
        $this->updateSession();
        return $this;
    }

    public function isEmpty()
    {
        return $this->ids->isEmpty();
    }

    public function isNotEmpty()
    {
        return $this->ids->isNotEmpty();
    }

    public function isExistProduct($product_id)
    {
        return $this->ids->contains($product_id);
    }

    public function addProduct($product_id)
    {
        if (!$this->ids->contains($product_id)) {
            $this->ids->push($product_id);
            $this->updateSession();
        }

        return $this;
    }

    public function removeProduct($product_id)
    {
        if ($this->ids->contains($product_id)) {
            $this->ids = $this->ids->reject(fn($id)=>$id==$product_id);
            $this->updateSession();
        }
        return $this;
    }

    public function toggleProduct($product_id)
    {
        if ($this->ids->contains($product_id)) {
            $this->ids = $this->ids->reject(fn($id) => $id == $product_id);
        } else {
            $this->ids->push($product_id);
        }
        $this->updateSession();
        return $this;
    }

    private function updateSession()
    {
        session()->put($this->sessionKey, [
            'products' => $this->ids->map(function ($id) {
                return [
                    'id' => $id,
                ];
            }),
        ]);

        $this->products = null;
    }

}
