<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];

    public $timestamps = false;

    const BASIC = [
        'type' => 'type',
        'purpose' => 'purpose',
        'packing' => 'packing',
        //'category'=>'category',
    ];
    protected $fillable = [
        'id_1c',
        'hidden',
        'slug',
        'basic',
        'status',
        'min',
        'max',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'attribute_values',
            'attribute_id',
            'product_id'
        );
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_attribute')
            ->withPivot('main');
    }

    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }

    /** ========== Scopes ========== */
    public function scopeOnlyBasic($query)
    {
        return $query->where('basic', 1);
    }
}
