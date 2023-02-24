<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserChange extends Model
{
    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
