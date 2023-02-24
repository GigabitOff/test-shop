<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentAttachment extends Model
{
    use HasFactory;

    const TYPE_UNDEFINED = 0;
    const TYPE_IMAGE = 1;

    protected $fillable = [
        'document_id',
        'type',
        'path',
    ];
}
