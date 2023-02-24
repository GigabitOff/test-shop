<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    use Translatable;

    const CASH = 1;  // Id для типа Касса(нал)
    const INVOICE = 2;  // Id для типа Счет(безнал)
    const LIQPAY = 3;  // Id для типа LiqPay(безнал)
    const POSTPAID = 4;  // Id для типа Postpaid(безнал)

    public $translatedAttributes = ['name'];

    public $timestamps = false;

    public function getCodeAttribute()
    {
        return $this->id === self::CASH
            ? 'nal'
            : 'beznal';
    }

    public function isLiqPay()
    {
        return $this->id === self::LIQPAY;
    }

    public function isCash()
    {
        return $this->id === self::CASH;
    }
}
