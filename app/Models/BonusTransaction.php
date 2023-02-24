<?php

namespace App\Models;

use App\Enums\BonusType;
use Illuminate\Database\Eloquent\Model;

class BonusTransaction extends Model
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'type' => BonusType::class,
    ];

    protected $fillable = ['customer_id','balance_before','transaction_value','balance_after','type','comment'];

}
