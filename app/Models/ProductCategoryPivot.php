<?php

namespace App\Models;

use App\Jobs\ProductCategoryPriceJob;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductCategoryPivot extends Pivot
{
    protected static function boot()
    {
        parent::boot();

        // ToDo: переподключить это через Observer
        // что бы можно было переподключать на разных проектах
//        static::created(function($model)
//        {
//            ProductCategoryPriceJob::dispatch($model->product);
//        });
//
//        static::deleted(function($model)
//        {
//            ProductCategoryPriceJob::dispatch($model->product);
//        });

    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
