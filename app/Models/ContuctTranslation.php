<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContuctTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'contuct_id',
        'lang',
        'title',
        'name',
        'fio',
        'img',
        'posada',
        'description',
        'body',
        'h1',
    ];

    public $timestamps = false;
}
