<?php

namespace App\Actions;

use App\Mail\ChangedProductPrices;
use App\Models\Product;
use App\Models\ProductPriceTracking;
use Illuminate\Support\Facades\Mail;

class EmailChangedProductPrices
{
    public function __invoke()
    {
        $users = ProductPriceTracking::with('customer')->get()->pluck('customer', 'customer_id');
        foreach ($users as $user) {
            $categories = [];
            foreach ($user->trackingProducts as $trackingProduct) {
                /** @var Product $product */
                $product = $trackingProduct->product;
                $priceField = Product::getPriceFieldWithParams($user, $product->price_sale, $product->price_wholesale,
                    $product->price_sale_show);
                if (!empty($product->$priceField) && $trackingProduct->product_price != $product->$priceField) {
                    $product->old_price = $trackingProduct->product_price;
                    $product->new_price = $product->$priceField;
                    $categories[$product->category_id ?? 0][] = $product;
                    ProductPriceTracking::where(
                        [
                            'customer_id' => $trackingProduct->customer_id,
                            'product_id'  => $trackingProduct->product_id,
                        ]
                    )->update([
                        'product_price' => $product->new_price,
                    ]);
                }
            }
            if (!empty($categories)) {
                Mail::to($user->email)->send(new ChangedProductPrices($user, $categories));
            }
        }
    }
}
