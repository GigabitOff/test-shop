<?php

namespace App\Services\DeliveryServices;

use Illuminate\Support\Facades\App;

/**
 * Базовый класс для сервисов доставки
 */
class BaseDeliveryService
{
    protected $lang;
    protected $shortListAttributes = true;    // флаг - отображать сокращенный список полей или полный

    public function __construct()
    {
        $this->lang = App::getLocale();
    }

    /**
     * Уточняет локаль
     * @param string $lang Локаль для Description. По умолчанию текущая локаль
     * @return $this
     */
    public function language($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Указывает возвращать полный список полей
     * @return $this
     */
    public function fullListAttributes()
    {
        $this->shortListAttributes = false;

        return $this;
    }

    /**
     * Указывает возвращать сокращенный список полей
     * @return $this
     */
    public function shortListAttributes()
    {
        $this->shortListAttributes = true;

        return $this;
    }


}
