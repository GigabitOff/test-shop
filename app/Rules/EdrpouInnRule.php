<?php

namespace App\Rules;

use App\Modules\Edr\Facade\EdrService;
use Illuminate\Contracts\Validation\Rule;

class EdrpouInnRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($this->checkInn((int)$value) || $this->checkEdrpou((int)$value))
            && EdrService::check($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('custom::site.edrpou_fail');
    }

    protected function checkEdrpou($edrpou)
    {
        if (strlen($edrpou) !== 8 && strlen($edrpou) !== 10) {
            return false;
        }

        if (strlen($edrpou) === 8) {
            if ($edrpou <= 30000000 || $edrpou >= 60000000) {
                $vk = [1, 2, 3, 4, 5, 6, 7];
            } else {
                $vk = [7, 1, 2, 3, 4, 5, 6];
            }
        }
        if (strlen($edrpou) === 10) {
            if ($edrpou <= 30000000 || $edrpou >= 60000000) {
                $vk = [3, 4, 5, 6, 7, 8, 9];
            } else {
                $vk = [9, 3, 4, 5, 6, 7, 8];
            }
        }

        $summ = 0;
        for ($i = 0; $i < 7; $i++) {
            $summ += ((int)substr($edrpou, $i, 1)) * ($vk[$i]);
        }

        $vkChk = $summ % 11;

        $kchk = (int)substr($edrpou, 7, 1);

        return ($vkChk === $kchk) || ($vkChk === 10 && $kchk === 0);
    }

    protected function checkInn($inn)
    {
        if (strlen($inn) !== 10) {
            return false;
        }

        $checkSumm = [10, 5, 7, 9, 4, 6, 10, 5, 7, 6, 8];

        $kSumm = 0;

        for ($i = 0; $i < 9; $i++) {
            $kSumm += ((int)substr($inn, $i, 1)) * ($checkSumm[$i]);
        }
        $ks = $kSumm % 11 % 10;

        return $ks === (int)substr($inn, 9, 1);
    }
}
