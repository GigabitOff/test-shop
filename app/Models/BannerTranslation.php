<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_id',
        'locale',
        'url',
        'img',
        'title_lable',
        'title',
        'description',
        'body',
    ];

    public $timestamps = false;
}
