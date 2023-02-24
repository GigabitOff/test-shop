<?php

namespace App\Modules\Localization;


use Illuminate\Support\Facades\Facade;

/**
 * App\Modules\Localization\LocalizationService
 *
 * @method static string defaultLocale()
 * @method static array getLocales()
 */
class LocalizationService extends Facade
{
    protected static function getFacadeAccessor() {
        return "Localization";
    }
}
