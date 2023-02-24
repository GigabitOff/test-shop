<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEntrance extends Model
{
    use HasFactory;

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected $fillable = [
        'id',
        'user_id',
        'IP',
        'session_id',
        'login_at',
        'logout_at',
    ];
}
