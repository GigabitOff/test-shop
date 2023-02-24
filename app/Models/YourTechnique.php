<?php

namespace App\Models;

use App\Traits\HasTansferred;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YourTechnique extends Model
{
    use HasFactory;
    use HasTansferred;

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
