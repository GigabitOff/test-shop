<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterpartyAdditionalUser extends Model
{
    use HasFactory;

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'id',
        'counterparty_id',
        'name',
        'phone',
        'email',
        'founder',
        'job',
    ];
}
