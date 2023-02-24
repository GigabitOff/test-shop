<?php

namespace App\Traits;

trait HasAvailability
{

    public function scopeOnlyInStock($query)
    {
        $query->whereIn('availability', [self::AVAILABILITY_IN_STOCK, self::AVAILABILITY_SMALL_STOCK]);
    }

    public function isAvailabilityInStock(): bool
    {
        return $this->availability === self::AVAILABILITY_IN_STOCK;
    }

    public function isAvailabilitySmallStock(): bool
    {
        return $this->availability === self::AVAILABILITY_SMALL_STOCK;
    }

    public function isAvailabilityStockExist(): bool
    {
        return $this->isAvailabilityInStock() || $this->isAvailabilitySmallStock();
    }

    public function isAvailabilityOutOfStock(): bool
    {
        return $this->availability === self::AVAILABILITY_OUT_OF_STOCK;
    }

}
