<?php

namespace App\Observers;

use App\Jobs\ProductBrandPriceJob;
use App\Models\Product;
use App\Services\ProductPriceService;

class ProductObserver
{
    public function creating(Product $product)
    {
        $this->updateCanBeSoldAvailabilityFields($product);
    }

    /**
     * Handle the Product "updating" event.
     *
     * @param  Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        if ($product->isDirty('brand_id')) {
            ProductBrandPriceJob::dispatch($product);
        }

        if ($product->isDirty(['on_backorder', 'stock', 'available'])) {
            $this->updateCanBeSoldAvailabilityFields($product);
        }
    }

    public function updated(Product $product)
    {
        // ToDo: Удалить после правки поля в админке.
        if ($product->isDirty('price_init')) {
            app()->make(ProductPriceService::class)
                ->updateProductPriceInit($product->id, $product->price_retail);
        }
        if ($product->isDirty('price_retail')) {
            app()->make(ProductPriceService::class)
                ->updateProductPriceInit($product->id, $product->price_retail);
        }
    }

    protected function updateCanBeSoldAvailabilityFields(Product $product)
    {
        $product->can_be_sold =
            $product->on_backorder || $product->stock > 0;

        $product->availability = $product->can_be_sold
            ? ($product->availability ?: Product::AVAILABILITY_IN_STOCK)
            : Product::AVAILABILITY_OUT_OF_STOCK;
    }
}
