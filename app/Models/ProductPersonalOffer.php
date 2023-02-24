<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPersonalOffer extends Product
{
    use HasFactory;
    use Translatable;

    protected string $childColumn = 'parental_type';

    /** Attributes */
    public function getPriceAttribute()
    {
        return $this->price_init;
    }

}
