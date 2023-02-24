<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'setting_id',
        'locale',
        'url',
        'description',
        'title',
        'value_lang',
        'img',
        'gallery',
    ];

    public $timestamps = false;
}
