<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterAttributeTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'filter_attribute_id',
        'locale',
        'title',
        'description',
    ];

    public $timestamps = false;
}
