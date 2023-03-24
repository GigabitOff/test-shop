<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\ProductPriceTracking;
use Illuminate\Support\Collection;

class EmailChangedProductPrices
{
    public function __invoke()
    {
        $users = ProductPriceTracking::with('customer')->get()->pluck('customer', 'customer_id');
        foreach ($users as $user) {
            $products = new Collection();
            foreach ($user->trackingProducts as $trackingProduct) {
                /** @var Product $product */
                $product = $trackingProduct->product;
                $priceField = Product::getPriceFieldWithParams($user, $product->price_sale, $product->price_wholesale,
                    $product->price_sale_show);
                if (!empty($product->$priceField) && $trackingProduct->product_price != $product->$priceField) {
                    $product->old_price = $trackingProduct->product_price;
                    $product->new_price = $product->$priceField;
                    $products->add($product);
                }
            }
            if ($products->isNotEmpty()) {
                // TODO: generate & send email
                // $view = view('', compact('user', 'products'));
            }
        }
    }
}
