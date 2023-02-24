<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Accumulated()
 * @method static static Available()
 */
final class BonusType extends Enum
{
    const Accumulated = 0;
    const Available = 1;
}
