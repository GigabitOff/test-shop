<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserTranslation
 *
 * @property int $id
 * @property int $user_id
 * @property string $locale
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|UserTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTranslation whereUserId($value)
 * @mixin \Eloquent
 */
class UserTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    protected $touches = ['user'];

    // need for $touches
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
