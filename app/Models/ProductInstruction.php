<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductInstruction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'url',
        'import_url',
        'last_modified',
        'status',
        'main',
        'file_name',
        'file_description',
    ];

    public function getFullUrlAttribute(): string
    {
        return $this->url && Storage::disk('public')->exists($this->url)
            ? Storage::disk('public')->url($this->url)
            : '';
    }

}
