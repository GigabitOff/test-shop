<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Модель договора.
 *
 * @property int $id
 * @property string $id_1c
 * @property int $counterparty_id Привязка к контрагенту
 * @property string $registry_no Реестровый номер
 * @property string $signing_at Дата подписания договора
 * @property string name Название
 * @property string status Статус
 * @property string payment_type Тип оплаты
 * @property string valid_at Дата начала действия
 * @property string valid_to Дата окончания действия
 * @property string sum Сумма
 * @property string comment Коментарий
 * @property string contract_file Файл контракта
 * @property string statute_file Файл устава
 */
class Contract extends Model
{
    const PAYMENT_TYPE_CASH = 'nal';
    const PAYMENT_TYPE_CASHLESS = 'beznal';
    const PAYMENT_TYPE_DEFAULT = 'beznal';

    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_1c',
        'counterparty_id',
        'registry_no',
        'name',
        'status',
        'payment_type',
        'valid_at',
        'sum',
        'comment',
        'contract_file',
        'statute_file',

    ];

    public function counterparty(): BelongsTo
    {
        return $this->belongsTo(Counterparty::class);
    }


}
