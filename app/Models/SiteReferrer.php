<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteReferrer extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'hash',
        'referrer_url',
        'referrer_title',
        'quantity',
    ];
}
