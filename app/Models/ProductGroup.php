<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductGroup extends Model
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;

    public $translatedAttributes = ['name'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_group',
            'group_id'
        )->using(ProductGroupPivot::class);
    }

    public function usersDiscount(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'discount_group',
            'group_id',
            'user_id'
        )->withPivot('discount');
    }

}
