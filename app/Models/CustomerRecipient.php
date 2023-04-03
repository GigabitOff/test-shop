<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRecipient extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['customer_id', 'name', 'delivery_address_id', 'fop_title', 'phone', 'inn'];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

}
