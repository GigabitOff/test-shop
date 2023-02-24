<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CategoryImage extends Model
{
    protected $fillable = [
        'category_id',
        'url',
        'import_url',
        'last_modified',
        'status',
        'main',
    ];

    public function getFullUrlAttribute(): string
    {
        return $this->url && Storage::disk('public')->exists($this->url)
            ? Storage::disk('public')->url($this->url)
            : '';
    }
}
