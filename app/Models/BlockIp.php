<?php

namespace App\Models;

use App\Services\IpFailedLoginService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockIp extends Model
{
    use HasFactory;

    protected $fillable = [
        'IP',
        'status',
        'hours',
        'phone_input',
        'end_time',
    ];

    protected $dates = [
          'updated_at',
          'created_at',
      ];

    protected static function boot()
    {
        parent::boot();
        static::saved(function (BlockIp $model) {
            if ($model->isDirty('end_time') && now() > Carbon::parse($model->end_time)){
                app()->make(IpFailedLoginService::class)
                    ->clearFailedLogins($model->phone_input);
            }
        });
    }

    /** ========== Scopes ========== */
    public function scopeStillBlocked($query)
    {
        $query->where('end_time', '>', now()->format('Y-m-d H:m:s'));
    }
}
