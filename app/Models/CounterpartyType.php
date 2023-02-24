<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterpartyType extends Model
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;

    public $translatedAttributes = ['name'];

    public function counterparties()
    {
        return $this->hasMany(Counterparty::class, 'type_id', 'id');
    }
}
