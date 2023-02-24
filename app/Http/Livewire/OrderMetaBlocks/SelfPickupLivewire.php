<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\DeliveryAddress;
use App\Models\Warehouse;
use Livewire\Component;

class SelfPickupLivewire extends Component
{
    use WithFilterableDropdown;

    // Данные передаются из внешнего компонента
    public ?int $deliveryAddressId = null;

    // локальные данные
    public array $data = [];
    public array $filterableWarehouse = [];

    protected array $rules = [
        'data.warehouse_id' => 'required',
    ];

    public function mount()
    {
        $this->initFilterable();
        $this->initSavedAddresses();
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.self-pickup-livewire', [
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updated($field, $value)
    {
        $this->updatedFilterable($field, $value);
    }

    public function messages()
    {
        return [
            'data.warehouse_id.required' => __('custom::site.choice_value_from_list'),
        ];
    }

    /** Service Functions */
    private function trySendAddress()
    {
        $this->updateDataFromValues();

        try {
            $this->validate();
        } catch (\Exception $e) {
            $this->emit('eventClearOrderDelivery');
            throw $e;
        }

        $this->emit('eventSetOrderDeliveryData', $this->data);
    }

    protected function initSavedAddresses()
    {
        if ($this->deliveryAddressId) {
            $this->updateDataFromSaved($this->deliveryAddressId);
        }
    }

    protected function updateDataFromSaved($id)
    {
        if ($address = DeliveryAddress::find($id)) {
            $warehouseId = $address->warehouse_id ?? 0;
            $this->data = [
                'delivery_id' => $id,
                'warehouse_id' => $warehouseId,
            ];

            if ($value = $this->filterableWarehouse['list'][$warehouseId] ?? 0) {
                $this->filterableWarehouse['id'] = $warehouseId;
                $this->filterableWarehouse['value'] = $value;
            }

        }
    }

    protected function updateDataFromValues()
    {
        $this->data = [
            'warehouse_id' => $this->filterableWarehouse['id'],
        ];
    }

    protected function onSetFilterableWarehouse($id, $name)
    {
        $this->trySendAddress();
    }

    protected function onResetFilterableWarehouse()
    {
        $this->trySendAddress();
    }

    protected function setFilterableWarehouseList($value): array
    {
        return Warehouse::query()
            ->withTranslation()->get()
            ->keyBy('id')->map->name->toArray();
    }
}
