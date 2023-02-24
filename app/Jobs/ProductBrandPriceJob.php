<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Brand;
use App\Services\ProductPriceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProductBrandPriceJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Product $product;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product->withoutRelations();
    }

    /**
     * Уникальный идентификатор задания.
     *
     * @return string
     */
    public function uniqueId(): string
    {
        return $this->product->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProductPriceService $service)
    {
        $service->updateBrandDiscountForProduct($this->product);
    }

}
