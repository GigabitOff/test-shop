<?php

namespace App\Http\Livewire\Traits;

use Exception;

/**
 * Extend for trait Livewire\WithPagination
 * Save PerPage param in the session
 *
 * Magic methods:
 *  - onPerPageChanged($value) - Fire when perPage param changed
 */
trait WithPerPage
{
    /**
     * Объявляем динамические переменные
     * Это дает возможность гибко настраивать их в классе владельце
     *
     *  public int $perPageDefault = 10;
     *  public array $perPageListItems = [5, 10, 15];
     *  protected array $perPageListItemsCount = 5;
     *  protected string $perPageKey = 'perPage';
     *
     * @return void
     * @throws Exception
     */
    public function bootWithPerPage()
    {
        $props = array_keys(get_object_vars($this));
        if (!in_array('perPageDefault', $props)) {
            $this->perPageDefault = 1;
        }
        if (!in_array('perPageKey', $props)) {
            $this->perPageKey = 'perPage';
        }
        if (!in_array('perPageListItemsCount', $props)) {
            $this->perPageListItemsCount = 5;
        }
        if (!in_array('perPageListItems', $props)) {
            $this->perPageListItems = $this->evaluatePerPageListItems();
        }


        if (empty($this->perPageListItems)) {
            throw new Exception('Variable perPageListItems can not be empty');
        }
    }

    public function getPerPageValue()
    {
        return session()->get($this->perPageKey, $this->perPageDefault);
    }

    public function setPerPage($value)
    {
        session()->put($this->perPageKey, $value);

        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }

        $method = 'onPerPageChanged';
        if (method_exists($this, $method)) {
            $this->{$method}($value);
        }
    }

    /**
     * Определяет старт счетчика отсчета количества элементов
     * Необходим для последовательного пересчета на разных страницах
     * @return int
     */
    public function getPerPageCounter(): int
    {
        $page = $this->resolvePage() - 1;
        return (int)($page * $this->getPerPageValue());
    }

    private function evaluatePerPageListItems(): array
    {
        for ($i = 1; $i <= $this->perPageListItemsCount; $i++) {
            $list[] = $i * $this->perPageDefault;
        }

        return $list ?? [];
    }
}
