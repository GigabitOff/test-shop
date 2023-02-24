<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGeoIp extends Model
{
    protected $table = 'user_geoip';

    protected $fillable = ['ip', 'latitude', 'longitude'];

    public $timestamps = false;
}
