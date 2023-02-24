<?php

namespace App\Modules\Comparisons;

use App\Models\Product;
use App\Models\User;
use App\Modules\Comparisons\Contracts\ComparisonsContract;

class ComparisonsByModel implements ComparisonsContract
{
    protected User $user;

    protected $ids;

    protected $products;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->refresh();
    }

    public function products()
    {
        /**
         * С большинстве случаев нет необходимости выгружать все товары
         * Поэтому делаем это только по запросу.
         */
        if (!$this->products) {
            $this->products = $this->user->compareProducts()->get();
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
        $this->user->compareProducts()->detach();
        $this->refresh();
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
        if (Product::where('id', $product_id)->count()) {
            if (!$this->ids->contains($product_id)) {
                $this->user->compareProducts()->attach($product_id);
                $this->refresh();
            }
        }

        return $this;
    }

    public function removeProduct($product_id)
    {
        $this->user->compareProducts()->detach($product_id);
        $this->refresh();
        return $this;
    }

    public function toggleProduct($product_id)
    {
        if (Product::where('id', $product_id)->count()) {
            if ($this->ids->contains($product_id)) {
                $this->user->compareProducts()->detach($product_id);
            }else {
                $this->user->compareProducts()->attach($product_id);
            }
            $this->refresh();
        }
        return $this;
    }

    private function refresh()
    {
        $this->ids = $this->user->compareProducts()->pluck('id');
        $this->products = null;
    }

}
