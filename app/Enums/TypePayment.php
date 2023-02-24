<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PaymentCash()
 * @method static static PaymentCashLess()
 */
final class TypePayment extends Enum
{
    const PaymentCash =   0;
    const PaymentCashLess =   1;
}
