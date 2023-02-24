<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static All()
 * @method static static ByGroups()
 * @method static static ByList()
 * @method static static ByGroupsAndList()
 */
final class ViewedType extends Enum
{
    const ByGroupsAndList = 0;
    const ByGroups = 1;
    const ByList = 2;
    const All = 3;
}
