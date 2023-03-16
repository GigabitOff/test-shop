<?php

namespace App\Modules\Cart;

use App\Models\Product;
use App\Modules\Cart\Contracts\CartContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartByModel implements CartContract
{
    protected $cart;

    public function __construct()
    {
        $this->cart = auth()->user()->cart()->firstOrCreate();
    }

    public function model()
    {
        return $this->cart;
    }

    public function products()

    {
        return $this->cart->products
            ->each(function ($el) {
                $el->cartUuid = $el->pivot->uuid;
                $el->cartQuantity = $el->pivot->quantity;
                $el->cartChecked = $el->pivot->checked;
                $el->cartPriceAdded = $el->pivot->price_added;
                if ($el->price_sale_show == 0 && $el->price_wholesale == 0) {
                    $el->cartCost = $el->price_rrc;
                } else if ($el->price_sale_show == 0) {
                    $el->cartCost = $el->price_wholesale * $el->cartQuantity;
                } else {
                    $el->cartCost = $el->price_sale * $el->cartQuantity;
                }
            });
    }

    public function productIds()
    {
        return $this->products()->pluck('id');
    }

    public function productUuids()
    {
        return $this->products()->pluck('cartUuid');
    }

    public function clear(): CartContract
    {
        $this->cart->products()->detach();
        return $this;
    }

    public function isNotEmpty(): bool
    {
        return (bool)$this->cart->products()->count();
    }

    public function isEmpty(): bool
    {
        return !$this->isNotEmpty();
    }

    public function totalQuantity()
    {
        return $this->products()->map->cartQuantity->sum();
    }

    public function totalCost()
    {
        return $this->products()->map->cartCost->sum();
    }

    public function checkedProducts()
    {

        return $this->products()->filter->cartChecked;
    }

    public function checkedProductIds()
    {
        return $this->checkedProducts()->pluck('id');
    }

    public function checkedProductUuids()
    {
        return $this->checkedProducts()->pluck('uuid');
    }

    public function totalCartCheckedQuantity()
    {
        return $this->checkedProducts()->map->cartQuantity->sum();
    }

    public function totalCartCheckedQuantityCount()
    {
        // Get all checked products
        $checkedProducts = $this->checkedProducts();
        // Return the count of unique products
        return $checkedProducts->count();
    }


    public function totalCartCheckedCost()
    {
        return $this->checkedProducts()->map->cartCost->sum();
    }

    public function checkProduct($product_id, $checked, $uniq = null): CartContract
    {
        $res = DB::table('cart_product')
            ->where('cart_id', $this->cart->id)
            ->where('product_id', $product_id)
            ->where('uniq', $uniq)
            ->update(['checked' => $checked]);

        if ($res) {
            $this->cart->refresh();
        }

        return $this;
    }

    public function checkProducts($uuid, $checked): CartContract
    {
        if ($uuid) {
            DB::table('cart_product')
                ->whereIn('uuid', (array)$uuid)
                ->update(['checked' => $checked]);
            $this->cart->refresh();
        }
        return $this;
    }

    public function addProduct($product_id, $quantity = 1, $uniq = null, $price_added = null): CartContract
    {
        if (Product::where('id', $product_id)->exists()) {
            $product = $this->cart->products()
                ->where('product_id', $product_id)
                ->wherePivot('uniq', $uniq)
                ->first();
            if ($product) {
                $this->setQuantity($product_id, $product->pivot->quantity + $quantity, $uniq);
                $this->setPriceAdded($product_id, $price_added, $uniq);
            } else {
                $this->cart->products()->attach($product_id, [
                    'uuid' => Str::orderedUuid(),
                    'quantity' => $quantity,
                    'uniq' => $uniq,
                    'price_added'=> $price_added,
                ]);
                $this->cart->refresh();
            }
        }

        return $this;
    }

    public function removeProducts($uuid): CartContract
    {
        if ($uuid) {
            DB::table('cart_product')
                ->whereIn('uuid', (array)$uuid)
                ->delete();
            $this->cart->refresh();
        }
        return $this;
    }

    public function removeProduct($product_id, $uniq = null): CartContract
    {
        DB::table('cart_product')
            ->where('cart_id', $this->cart->id)
            ->where('product_id', $product_id)
            ->where('uniq', $uniq)
            ->delete();
        $this->cart->refresh();
        return $this;
    }

    public function setQuantity($product_id, $quantity = 1, $uniq = null): CartContract
    {
        $query = $this->cart->products()
            ->where('product_id', $product_id)
            ->wherePivot('uniq', $uniq);
        if ($query->exists()) {
            $this->cart->products()
                ->wherePivot('uniq', $uniq)
                ->updateExistingPivot($product_id, ['quantity' => $quantity]);
            $this->cart->refresh();
        } else {
            $this->addProduct($product_id, $quantity, $uniq);
        }
        return $this;
    }

    public function setPriceAdded($product_id, $price_added = null, $uniq = null): CartContract
    {
        $query = $this->cart->products()
            ->where('product_id', $product_id)
            ->wherePivot('uniq', $uniq);
        if ($query->exists()) {
            $this->cart->products()
                ->wherePivot('uniq', $uniq)
                ->updateExistingPivot($product_id, ['price_added' => $price_added]);
            $this->cart->refresh();
        }
        return $this;
    }

    public function getQuantity($product_id, $uniq = null)
    {
        $product = $this->cart->products()
            ->where('product_id', $product_id)
            ->wherePivot('uniq', $uniq)
            ->first();

        return $product
            ? $product->pivot->quantity
            : 0;
    }

    public function getProductByUuid($uuid)
    {
        return $uuid
            ? $this->products()->where('cartUuid', $uuid)->first()
            : null;
    }
}
