<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface for Model
 */
interface ImagesOwnerContract
{
    public function images(): HasMany;

    public function getStorageUri(): string;
}
