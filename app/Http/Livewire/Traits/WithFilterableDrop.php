<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Str;

/**
 * Trait FilterableDrop to processed dropdown components via Livewire
 *
 * @author  Anatoliy Pychev
 * @version 2.0
 *
 * Just create new public string field with prefix filtered (like filteredItem)
 *
 * Trait create public class fields as an addition of {$prop}
 * {$prop}Id    - for selected list item key
 * {$prop}List  - for option values
 *
 * Dynamic methods
 * - set{$prop}List($value) -- call to fill filterable list with items
 * - onUpdated{$prop}Value($value) -- call after property value will be updated
 * - onSetFilterable($prop, $id, $name) -- call when filterable is set to new id-value
 * - onSet{$prop}($id, $name) -- call individual when filterable is set to new id-value
 * - onResetFilterable($prop) -- call on reset filterable item
 * - onReset{$prop} -- call individual on reset filterable item
 */
trait WithFilterableDrop
{
    public array $filterablies = [];

    public function mountWithFilterableDrop()
    {
        foreach ($this->getFilterableProps() as $prop) {
            $this->filterablies[] = $prop;
            $propId = "{$prop}Id";
            $propList = "{$prop}List";
            $this->{$propId} = '';
            $this->{$propList} = $this->setFilterableList($prop, '');
        }
        $method = 'filterableMounted';
        if (method_exists($this, $method)) {
            $this->{$method}();
        }
    }

    public function updatedWithFilterableDrop($prop, $value)
    {
        if (in_array($prop, $this->filterablies)) {
            $value = trim($value);
            $propId = "{$prop}Id";
            $propList = "{$prop}List";

            $this->resetFilterableKeyOnChange($prop, $propId);

            $method = 'onUpdated' . ucfirst($prop) . 'Value';
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            }

            $this->{$propList} = $this->setFilterableList($prop, $value);
        }
    }

    /**
     * Only for inner work.
     * Do not call from owner class.
     * @param $prop
     * @return void
     */
    public function dropFilterable($prop)
    {
        if (in_array($prop, $this->filterablies)) {
            $this->resetFilterable($prop);

            $method = 'droppedFilterable';
            if (method_exists($this, $method)) {
                $this->{$method}();
            }

            $method = 'dropped' . ucfirst($prop);
            if (method_exists($this, $method)) {
                $this->{$method}();
            }

        }
    }

    public function resetFilterable($prop)
    {
        if (in_array($prop, $this->filterablies)) {
            $this->reset($prop);
            $propId = "{$prop}Id";
            $propList = "{$prop}List";
            $this->{$propId} = '';
            $this->{$propList} = $this->setFilterableList($prop, '');

            if (method_exists($this, 'onResetFilterable')) {
                $this->onResetFilterable($prop);
            }

            $method = 'onReset' . ucfirst($prop);
            if (method_exists($this, $method)) {
                $this->{$method}();
            }
        }
    }

    public function setFilterableSelect($prop, $id, $value)
    {
        if (in_array($prop, $this->filterablies)) {
            $propId = "{$prop}Id";

            if ($this->{$propId} != $id) {
                $this->{$propId} = $id;
                $this->{$prop} = $value;

                if (method_exists($this, 'onSetFilterable')) {
                    $this->onSetFilterable($prop, $id, $value);
                }
                $method = 'onSet' . ucfirst($prop);
                if (method_exists($this, $method)) {
                    $this->{$method}($id, $value);
                }
            }
        }
    }

    protected function setFilterableKey(string $prop, string $value)
    {
        if (in_array($prop, $this->filterablies)) {
            $propId = "{$prop}Id";
            $this->{$propId} = $value;
        }
    }

    protected function getFilterableKey(string $prop): string
    {
        if (in_array($prop, $this->filterablies)) {
            $propId = "{$prop}Id";
            return $this->{$propId};
        }

        return '';
    }

    protected function getFilterableList(string $prop): array
    {
        if (in_array($prop, $this->filterablies)) {
            $propList = "{$prop}List";
            return $this->{$propList};
        }

        return [];
    }

    protected function freshFilterableList($prop, $value)
    {
        if (in_array($prop, $this->filterablies)) {
            $propList = "{$prop}List";
            $this->{$propList} = $this->setFilterableList($prop, $value);
        }
    }

    private function setFilterableList($prop, $value): array
    {
        $method = 'set' . ucfirst($prop) . 'List';
        return method_exists($this, $method)
            ? (array)$this->{$method}($value)
            : [];
    }

    private function getFilterableProps(): array
    {
        return collect(array_keys(get_object_vars($this)))
            ->filter(fn($el) => Str::startsWith($el, 'filterable'))
            ->toArray();
    }

    /**
     * Reset value of property Key
     * User can disable this by declaring protected property "reset{$prop}KeyOnChange" to false
     *
     * @param string $prop
     * @param string $propId
     * @return void
     */
    private function resetFilterableKeyOnChange(string $prop, string $propId)
    {
        $resetKey = "reset{$prop}KeyOnChange";
        if (!property_exists($this, $resetKey) || $this->{$resetKey}) {
            $this->{$propId} = '';
        }
    }

}
