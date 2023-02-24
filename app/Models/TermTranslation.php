<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermTranslation extends Model
{
    protected $fillable = [
        'value',
    ];

    public $timestamps = false;
}
