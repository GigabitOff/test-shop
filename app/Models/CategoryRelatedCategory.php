<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRelatedCategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'category_related_categories';

    protected $fillable = [
        'category_id',
        'related_id',
    ];
}
