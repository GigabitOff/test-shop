<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Str;

/**
 * Dynamic methods
 * - set{$prop}List($value) -- call to fill filterable list with items
 * - onUpdating{$prop}Value($value) -- call before property value will be updated
 * - onSetFilterable($prop, $id, $name) -- call when filterable is set to new id-value
 * - onSet{$prop}($id, $name) -- call individual when filterable is set to new id-value
 * - onResetFilterable($prop) -- call on reset filterable item
 * - onReset{$prop} -- call individual on reset filterable item
 */
trait WithFilterableDropdown
{

    protected string $filterableMode = '';

    public function initFilterable()
    {
        foreach (array_keys($this->getFilterableProps()) as $prop) {
            $template = $this->makeFilterableTemplate();
            $template['list'] = $this->setFilterableList($prop, '');
            $this->{$prop} = $template;
        }
    }

    public function updatedFilterable($field, $value)
    {
        if (false !== strpos($field, 'filterable')) {
            $prop = str_replace(['.value'], '', $field);
            $value = trim($value);
            if (property_exists($this, $prop)) {
                $method = 'onUpdating' . ucfirst($prop) . 'Value';
                if (method_exists($this, $method)) {
                    $this->{$method}($value);
                }

                $item = $this->{$prop};
                $item['id'] = '';
                $item['name'] = $value;
                $item['list'] = $this->setFilterableList($prop, $value);
                $this->{$prop} = $item;

                $this->filterableMode = empty($item['list']) ? '' : $prop;
            }
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
        if (property_exists($this, $prop)) {
            $this->resetFilterable($prop, true);

            $this->filterableMode = empty($this->{$prop}['list']) ? '' : $prop;
        }
    }

    public function resetFilterable($prop, $dropped = false)
    {
        if (property_exists($this, $prop)) {
            $this->initFilterableItem($prop);
            if ($dropped) {
                $this->filterableMode = empty($this->{$prop}['list']) ? '' : $prop;
            }

            if (method_exists($this, 'onResetFilterable')) {
                $this->onResetFilterable($prop);
            }

            $method = 'onReset' . ucfirst($prop);
            if (method_exists($this, $method)) {
                $this->{$method}();
            }
        }
    }

    public function setFilterable($prop, $id, $name)
    {
        if (property_exists($this, $prop)) {
            $item = $this->{$prop};
            $item['id'] = $id;
            $item['value'] = $name;
            $this->{$prop} = $item;

            if (method_exists($this, 'onSetFilterable')) {
                $this->onSetFilterable($prop, $id, $name);
            }
            $method = 'onSet' . ucfirst($prop);
            if (method_exists($this, $method)) {
                $this->{$method}($id, $name);
            }
        }
    }

    private function initFilterableItem($prop)
    {
        $template = $this->makeFilterableTemplate();
        $template['list'] = $this->setFilterableList($prop, '');
        $this->{$prop} = $template;
    }

    private function setFilterableList($prop, $value): array
    {
        $method = 'set' . ucfirst($prop) . 'List';
        return method_exists($this, $method)
            ? (array)$this->{$method}($value)
            : [];
    }

    private function makeFilterableTemplate(): array
    {
        return [
            'value' => '',
            'id' => '',
            'list' => [],
        ];
    }

    private function getFilterableProps(): array
    {
        $props = get_object_vars($this);
        unset($props['filterableMode']);
        foreach (array_keys($props) as $prop) {
            if (!Str::startsWith($prop, 'filterable')) {
                unset($props[$prop]);
            }
        }

        return $props;
    }

}
