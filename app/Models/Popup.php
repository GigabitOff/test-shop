<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'name',
    ];

    public function contucts()
    {
        return $this->belongsToMany(Contuct::class, 'popup_contucts','popup_id', 'contuct_id');
    }
}
