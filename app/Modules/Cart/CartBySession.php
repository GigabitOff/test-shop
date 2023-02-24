<?php

namespace App\Modules\Cart;

use App\Models\Product;
use App\Modules\Cart\Contracts\CartContract;
use Illuminate\Support\Str;

class CartBySession implements CartContract
{
    /**
     * Cart session structure
     * [
     *   products => [
     *     [ uuid => '', id => 0, uniq => '', quantity => 0, checked => false ],
     *   ]
     * ]
     */

    protected string $sessionKey = 'cart';
    protected $products;

    public function __construct()
    {
        $cart = collect(session()->get($this->sessionKey, []));
        if ($cart->has('products')) {
            $sessionProducts = collect($cart['products']);

            $this->products = $sessionProducts->isNotEmpty()
                ? Product::query()->whereIn('id', $sessionProducts->map->id)->get()
                : collect([]);

            $this->products->each(function($el) use($sessionProducts){
                $product = $sessionProducts->firstWhere('id', $el->id);
                $el->cartUuid = $product['uuid'] ?? Str::orderedUuid();
                $el->cartUniq = $product['uniq'] ?? null;
                $el->cartQuantity = $product['quantity'] ?? 0;
                $el->cartCost = $el->price * $el->cartQuantity;
                $el->cartChecked = $product['checked'] ?? false;
            });

        } else {
            $this->products = collect([]);
            $this->updateSession();
        }
    }

    public function model()
    {
        return null;
    }

    public function products()
    {
        // Учет динамического изменения цены
        return $this->products
            ->each(function ($el) {
                $el->cartCost = $el->price * $el->cartQuantity;
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
        $this->products = collect([]);
        $this->updateSession();
        return $this;
    }

    public function isEmpty(): bool
    {
        return $this->products->isEmpty();
    }

    public function isNotEmpty(): bool
    {
        return $this->products->isNotEmpty();
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
        return $this->checkedProducts()->pluck('cartUuid');
    }

    public function totalCartCheckedQuantity()
    {
        return $this->checkedProducts()->map->cartQuantity->sum();
    }

    public function totalCartCheckedCost()
    {
        return $this->checkedProducts()->map->cartCost->sum();
    }

    public function checkProduct($product_id, $checked, $uniq = null): CartContract
    {
        $products = $this->products
            ->where('id', $product_id)
            ->when($uniq, fn($c) => $c->where('cartUniq', $uniq))
            ->when(!$uniq, fn($c) => $c->whereNull('cartUniq'));
        if ($products->isNotEmpty()){
            $products->each(function ($p) use ($checked) {
                $p->cartChecked = (bool)$checked;
            });
            $this->updateSession();
        }
        return $this;
    }

    public function checkProducts($uuid, $checked): CartContract
    {
        $products = $this->products->whereIn('cartUuid', (array)$uuid);
        if ($products->isNotEmpty()){
            $products->each(function ($p) use ($checked) {
                $p->cartChecked = (bool)$checked;
            });
            $this->updateSession();
        }
        return $this;
    }

    public function addProduct($product_id, $quantity = 1, $uniq = null, $price_added= null): CartContract
    {
        if ($product = Product::where('id', $product_id)->first()) {
            $saved = $this->products
                ->where('id', $product_id)
                ->where('cartUniq', $uniq)
                ->first();
            if ($saved) {
                $saved->cartQuantity += $quantity;
                $saved->cartCost = $saved->price * $saved->cartQuantity;
                $saved->cartPriceAdded = $price_added;
            } else {
                $product->cartUuid = Str::orderedUuid();
                $product->cartUniq = $uniq;
                $product->cartQuantity = $quantity;
                $product->cartCost = $product->price * $quantity;
                $product->cartPriceAdded = $price_added;
                $product->cartChecked = false;
                $this->products->push($product);
            }
            $this->updateSession();
        }

        return $this;
    }

    public function setPriceAdded($product_id, $price_added = null, $uniq = null): CartContract
    {
        $saved = $this->products
            ->where('id', $product_id)
            ->where('cartUniq', $uniq)
            ->first();
        if ($saved) {
            $saved->cartPriceAdded = $price_added;
        }
        $this->updateSession();

        return $this;
    }

    public function removeProducts($uuid): CartContract
    {
        $this->products = $this->products->reject(fn($p) => $p->cartUuid === $uuid);
        $this->updateSession();
        return $this;
    }

    public function removeProduct($product_id, $uniq = null): CartContract
    {
        $this->products = $this->products
            ->reject(fn($p) => $p->id === $product_id && $p->cartUniq == $uniq);
        $this->updateSession();
        return $this;
    }

    public function setQuantity($product_id, $quantity = 1, $uniq = null): CartContract
    {
        $saved = $this->products
            ->where('id', $product_id)
            ->where('cartUniq', $uniq)
            ->first();
        if ($saved) {
            $saved->cartQuantity = $quantity;
            $saved->cartCost = $saved->price * $quantity;
        } else {
            $this->addProduct($product_id, $quantity, $uniq);
        }
        $this->updateSession();

        return $this;
    }

    public function getQuantity($product_id, $uniq = null)
    {
        return $this->products
                ->where('id', $product_id)
                ->where('cartUniq', $uniq)
                ->first()
                ->cartQuantity ?? 0;
    }

    public function getProductByUuid($uuid)
    {
        return $uuid
            ? $this->products->where('cartUuid', $uuid)->first()
            : null;
    }

    private function updateSession()
    {
        session()->put($this->sessionKey, [
            'products' => $this->products->map(function($product){
                return [
                    'id' => $product->id,
                    'quantity' => $product->cartQuantity,
                    'checked' => $product->cartChecked,
                    'uuid' => $product->cartUuid,
                    'uniq' => $product->cartUniq,
                ];
            }),
        ]);
    }
}
