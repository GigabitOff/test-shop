<?php

namespace App\Models;

use App\Jobs\ProductGroupPriceJob;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductGroupPivot extends Pivot
{
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            ProductGroupPriceJob::dispatch($model->product);
        });

        static::deleted(function ($model) {
            ProductGroupPriceJob::dispatch($model->product);
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
