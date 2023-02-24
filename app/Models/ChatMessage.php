<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $touches = ['chat'];

    protected $fillable = ['owner_id', 'message'];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            /**
             * Защищаем от XSS-атак
             * Обрамляем ссылки тегами <a>
             */
            $encoded = htmlspecialchars($model->message);
            $pattern = "/((https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w\.-]*)*\/?\??[^\s]*)/";
            $replacement = '<a href="$1">$1</a>';
            $model->message = preg_replace($pattern, $replacement, $encoded);
        });
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
