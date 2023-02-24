<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterpartyTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_id',
        'locale',
        'form',
        'title',
        'description',
        'body',
    ];

    public $timestamps = false;
}
