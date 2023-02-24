<?php
/**
 * Common Helpers
 */

use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Support\Str;

if (!function_exists('stringDigit')) {
    /**
     * Возвращает произвольную строку из цифр указанной длины.
     * @param int $length Длина возвращаемой строки
     * @return string
     */
    function stringDigit(int $length = 6): string
    {
        return substr(implode('', Arr::shuffle(range(0, 9))), 0, $length);
    }
}

if (!function_exists('settingsData')) {
    /**
     * Возвращает настройку из таблицы настроек.
     * @param int $key
     * @param null|bool $onlyValue Если не null то вернется вся строка из таблицы
     * @return string|App\Models\Setting
     */
    function settingsData($key = 0, $onlyValue = false)
    {
        $value = '';
        $res = Setting::where('key', $key)->first();

        if(isset($res->value))
        $value = $res->value;
        if(isset($res->value_lang) AND $res->value_lang != '')
        $value = $res->value_lang;

        return ($res && $onlyValue) ? $value : $res;
    }
}

if (!function_exists('setSettings')) {
    function setSettings($key)
    {
        $value = '';
        if(isset($key['value']))
            $value = $key['value'];
        if(isset($key['value_lang']) AND $key['value_lang'] != '')
            $value = $key['value_lang'];

        return $value;
    }
}

if (!function_exists('settingsDataCategory')) {
    /**
     * Возвращает настройку из таблицы настроек.
     * @param int $key
     * @param null|bool $onlyValue Если не null то вернется вся строка из таблицы
     * @return string|App\Models\Setting
     */
    function settingsDataCategory($category='phones_top',$all=null)
    {
          $return = [];

        $res = Setting::where('category', $category)->orderBy('order','ASC')->get();
        if($all === null AND count($res)>0)
        {
          foreach ($res as $key => $item) {
              $return[$key] = $item->value;
          }
        }else{
          $return = $res;
        }

        return count($return)>0 ? $return : null;
    }
}

if (!function_exists('formatPhoneNumber')) {
    /**
     * Форматирует номер телефона в одном стиле.
     * @param mixed $phone
     * @return string
     */
    function formatPhoneNumber($phone): string
    {
        return preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{4})$/", "+$1/$2/ $3 $4", $phone);
    }
}

if (!function_exists('clearPhoneNumber')) {
    /**
     * Форматирует номер ЕДРПОУ в одном стиле.
     * @param mixed $number
     * @return string
     */
    function clearPhoneNumber($number, $tr = null): string
    {

        $res = preg_replace('/[^\d]/', '', $number);

        if ($tr !== null)
            $res = substr($res, $tr);

        return $res;
    }
}

if (!function_exists('formatEdrpouNumber')) {
    /**
     * Форматирует номер ЕДРПОУ в одном стиле.
     * @param mixed $number
     * @return string
     */
    function formatEdrpouNumber($number): string
    {
        return preg_replace("/^(\d{4})(\d{4})(\d*)$/", "$1 $2 $3", $number);
    }
}

if (!function_exists('getMenuItem')) {
    /**
     * Форматирует номер телефона в одном стиле.
     * @param string $phone
     * @return string
     */
    function getMenuItem($item)
    {
        $res = Menu::where('slug', $item)->first();
        return $res;
    }
}

if (!function_exists('getPageItem')) {
    /**
     * Форматирует номер телефона в одном стиле.
     * @param string $phone
     * @return string
     */
    function getPageItem($item)
    {
        $res = Page::where('slug', $item)->where('status',1)->first();
        return $res;
    }
}

if (!function_exists('formatDate')) {
    /**
     * Форматирует дату в указанном стиле.
     * @param string|null $date
     * @param string|null $format
     * @return string
     */
    function formatDate(?string $date, ?string $format = null) : string
    {
        if ($date) {
            $format = $format ?? config('app.date_formats.date');
            try {
                return Carbon::parse($date)->format($format);
            } catch (Exception $e) {
            }
        }

        return '';
    }
}

if (!function_exists('formatDateTime')) {
    /**
     * Форматирует дату и время в указанном стиле.
     * @param string|null $date
     * @param string|null $format
     * @return string
     */
    function formatDateTime(?string $date, ?string $format = null) : string
    {
        if ($date) {
            $format = $format ?? config('app.date_formats.date_time');
            try {
                return Carbon::parse($date)->format($format);
            } catch (Exception $e) {
            }
        }

        return '';
    }
}

if (!function_exists('formatMoney')) {
    /**
     * Форматирует валюту в указанном стиле.
     * @param mixed $money
     * @param int $decimal
     * @param string $decimal_separator
     * @param string $thousands_separator
     * @return string
     */
    function formatMoney($money, $decimal = 2, $decimal_separator = '.', $thousands_separator = ' '): string
    {
        return number_format($money, $decimal, $decimal_separator, $thousands_separator);
    }
}

if (!function_exists('formatVolume')) {
    /**
     * Форматирует значения Объема в указанном стиле.
     * @param mixed $value
     * @param int $decimal
     * @param string $decimal_separator
     * @param string $thousands_separator
     * @return string
     */
    function formatVolume($value, $decimal = 3, $decimal_separator = '.', $thousands_separator = ' '): string
    {
        return number_format($value, $decimal, $decimal_separator, $thousands_separator);
    }
}

if (!function_exists('formatWeight')) {
    /**
     * Форматирует значения Веса в указанном стиле.
     * @param mixed $value
     * @param int $decimal
     * @param string $decimal_separator
     * @param string $thousands_separator
     * @return string
     */
    function formatWeight($value, $decimal = 2, $decimal_separator = '.', $thousands_separator = ' '): string
    {
        return number_format($value, $decimal, $decimal_separator, $thousands_separator);
    }
}

if (!function_exists('formatNbsp')) {
    /**
     * Заменяет пробелы на неразрывные пробелы.
     * @param mixed $value
     * @return string
     */
    function formatNbsp($value): string
    {
        return str_replace(' ', '&nbsp;', (string)$value);
    }
}

if (!function_exists('numericCases')) {
    /**
     * Выбирает правильное склонение для числовых характеристик.
     * @param int|float $value
     * @param string $forSingle
     * @param string $forDouble
     * @param string $forMultiple
     * @return string
     */
    function numericCases($value, string $forSingle, string $forDouble, string $forMultiple): string
    {
        $value = (int) $value;
        $sign = (int) substr($value, -1, 1);

        if (1 === $sign) {
                return $forSingle;
        }
        // Исключаем числа 11...19 т.к. они описываются как с окончанием >= 5
        if (($value < 11 || $value > 19) && in_array($sign, [2,3,4])){
            return $forDouble;
        }

        return $forMultiple;
    }
}

if (!function_exists('numericCasesLang')) {
    /**
     * Выбирает правильное склонение для числовых характеристик.
     * Подставляет правильные ключи для множественных переводов.
     *
     * @param int|float $value
     * @param string $key
     * @return string
     */
    function numericCasesLang($value, string $key): string
    {
        return numericCases(
            $value,
            __($key),
            __("{$key}_d"),
            __("{$key}_m")
        );
    }
}

if (!function_exists('cart')) {
    /**
     * Возвращает сервис работы с корзиной.
     * @return \App\Modules\Cart\Contracts\CartContract
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function cart()
    {
        return app()->make(\App\Modules\Cart\Contracts\CartContract::class);
    }
}

if (!function_exists('favourites')) {
    /**
     * Возвращает сервис работы с Избранным.
     * @return \App\Modules\Favourites\Contracts\FavouritesContract
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function favourites()
    {
        return app()->make(\App\Modules\Favourites\Contracts\FavouritesContract::class);
    }
}

if (!function_exists('comparisons')) {
    /**
     * Возвращает сервис работы с таблицей Сравнения.
     * @return \App\Modules\Comparisons\Contracts\ComparisonsContract
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function comparisons()
    {
        return app()->make(\App\Modules\Comparisons\Contracts\ComparisonsContract::class);
    }
}

if (!function_exists('orders')) {
    /**
     * Возвращает сервис работы с заказами.
     * @return \App\Services\OrdersService
     * @throws Throwable
     */
    function orders(): \App\Services\OrdersService
    {
        return app()->make(\App\Services\OrdersService::class);
    }
}

if (!function_exists('bonuses')) {
    /**
     * Возвращает сервис работы с бонусами.
     * @return \App\Services\BonusService
     * @throws Throwable
     */
    function bonuses(): \App\Services\BonusService
    {
        return app()->make(\App\Services\BonusService::class);

    }
}

if (!function_exists('cashback')) {
    /**
     * Возвращает сервис работы с Кэшбеком.
     * @return \App\Services\CashbackService
     * @throws Throwable
     */
    function cashback(): \App\Services\CashbackService
    {
        return app()->make(\App\Services\CashbackService::class);

    }
}

if (!function_exists('createSlugAndCheckUnique')) {
    /**
     * Создает слаг и проверяет уникальность.
     * @param string $title Исходник для слага
     * @param string $model Имя класса модели
     * @param string $field Поле в БД в котором хранится слаг
     * @return string
     */
    function createSlugAndCheckUnique($title, $model, $field = 'slug')
    {
        $slug = Str::slug($title);
        $useSoftDeletes = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($model));
        $similar = $model::where($field, 'like', "{$slug}%")
            ->when($useSoftDeletes, fn($q) => $q->withTrashed())
            ->pluck($field)->toArray();
        if ($similar){
            $index = 1;
            do {
                $slug .= "-{$index}";
                if (!in_array($slug, $similar)){
                    break;
                }
                $index ++;
            } while ($index < 1000);
            if ($index >= 1000){
                $slug .= Str::random();
            }
        }

        return $slug;
    }
}

if (!function_exists('createUniqueSlug')) {
    /**
     * Создает уникальны слаг.
     * Функция создана как более простая замена createSlugAndCheckUnique
     *
     * @param string $title Исходник для слага
     * @param string $model Имя класса модели
     * @param string $field Поле в БД в котором хранится слаг
     * @return string
     */
    function createUniqueSlug(string $title, string $model, string $field = 'slug'): string
    {
        $slug = $title
            ? Str::slug($title)
            : Str::random();

        $count = $model::whereRaw("{$field} RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}

if (!function_exists('isLivewireRequest')) {
    /**
     * Check if request is livewire.
     * @return bool
     */
    function isLivewireRequest(): bool
    {
        return 'livewire' === str_replace('/', '', request()->segment(1, ''));
    }
}

if (!function_exists('pageRange')) {
    /**
     * Return page range.
     * @return array
     */
    function pageRange($page,$pageCount,$step=2)
    {
        $start = $page - $step;
        $end = $page + $step;

        if ($end > $pageCount) {
            $start -= ($end - $pageCount);
            $end = $pageCount;
        }
        if ($start <= 0) {
            $end += (($start - 1) * (-1));
            $start = 1;
        }

        $end = $end > $pageCount ? $pageCount : $end;

        return ["start" => $start, "end" => $end];
    }
}

if (!function_exists('isColorCodeValid')) {
    /**
     * Проверяет код цвета на соответствие формату #000000.
     * @param $code
     * @return boolean
     */
    function isColorCodeValid($code): bool
    {
        return preg_match('/#[\da-fA-F]{6}/', (string)$code);
    }
}

if (!function_exists('isColorCodeInvalid')) {
    /**
     * Проверяет код цвета на несоответствие формату #000000.
     * @param $code
     * @return boolean
     */
    function isColorCodeInvalid($code): bool
    {
        return ! isColorCodeValid((string)$code);
    }
}

