<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'action_id',
        'user_id',
        'quantity',
    ];

    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
