<?php

namespace App\Models;

use App\Traits\HasDigitScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Debt
 *
 * @property int $id
 * @property string $id_1c
 * @property int $user_id
 * @property string|null $currency
 * @property int|null $otsrochka_days
 * @property float|null $credit_limit
 * @property float|null $sum_debt_total
 * @property float|null $sum_prosrocheno
 * @property int|null $days_prosrocheno
 * @property string|null $date
 * @method static \Illuminate\Database\Eloquent\Builder|Debt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debt query()
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereCreditLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereDaysProsrocheno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereId1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereOtsrochkaDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereSumDebtTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereSumProsrocheno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereUserId($value)
 * @mixin \Eloquent
 */
class Debt extends Model
{
    use HasFactory;
    use HasDigitScopes;

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
