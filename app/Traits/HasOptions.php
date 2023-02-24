<?php

namespace App\Traits;

trait HasOptions
{
    /**
     * Добавление опции
     */
    public function setOption(string $key, $value, bool $save = false)
    {
        if (!$key) {
            return;
        }

        $this->options = array_merge(
            (array)$this->options,
            [$key => $value],
        );

        if ($save) {
            $this->save();
        }
    }

    /**
     * Получение опции
     */
    public function getOption(string $key, $default = null)
    {
        if (!$key) {
            return $default;
        }

        return ((array)$this->options)[$key] ?? $default;
    }

    /**
     * Удаление опции
     */
    public function unsetOption(string $key, bool $save = false)
    {
        if (!$key) {
            return;
        }

        $options = (array)$this->options;
        unset($options[$key]);
        $this->options = $options;

        if ($save) {
            $this->save();
        }
    }

    /**
     * проверка наличия опции
     */
    public function isOptionExists(string $key): bool
    {
        if (!$key) {
            return false;
        }

        $options = (array)$this->options;
        return isset($options[$key]);
    }

}
