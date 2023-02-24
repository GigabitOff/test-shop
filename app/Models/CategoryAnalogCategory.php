<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAnalogCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'category_analog_categories';

    protected $fillable = [
        'category_id',
        'related_id',
    ];

    public function category()
    {
        return $this->hasOne(Category::class,'id','related_id');
    }
}
