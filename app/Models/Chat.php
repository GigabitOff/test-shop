<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    const SOURCE_MESSAGE = 'message';
    const SOURCE_VACANCY = 'vacancy';
    const SOURCE_PRIVATE = 'private';

    protected $fillable = ['manager_id', 'customer_id', 'department_id', 'closed', 'fio', 'phone', 'source'];

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'chat_id');
    }

    public function latestMessage()
    {
        return $this->messages()->latest();
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function department()
    {
        return $this->belongsTo(Contuct::class);
    }
}
