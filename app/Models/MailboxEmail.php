<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MailboxEmail extends Model
{
    const DIRECTION_OUT = 0;    // Исходящее от клиента
    const DIRECTION_IN = 1;     // Входящее к клиенту

    protected $fillable = [
        'customer_id',
        'department_id', 'popup_id', 'uid', 'body', 'inout', 'dispatch_at'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function isEmailIn(): bool
    {
        return $this->inout === self::DIRECTION_IN;
    }
    public function isEmailOut(): bool
    {
        return $this->inout === self::DIRECTION_OUT;
    }
}
