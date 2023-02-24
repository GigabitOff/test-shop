<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['value'];

    protected $fillable = [
        'id_1c',
        'attribute_id',
        'slug',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
