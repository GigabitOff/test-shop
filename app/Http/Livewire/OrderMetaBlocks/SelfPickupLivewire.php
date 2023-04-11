<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\City;
use App\Models\DeliveryAddress;
use App\Models\Warehouse;
use Livewire\Component;

use App\Models\ShopCity;
use App\Models\Contract;
use App\Models\DeliveryType;
use Illuminate\Database\Eloquent\Model;

class SelfPickupLivewire extends Component
{
    use WithFilterableDropdown;

    // Данные передаются из внешнего компонента
    public ?int $deliveryAddressId = null;

    // локальные данные
    public array $data = [];
    public array $filterableWarehouse = [];
    public array $filterableCity = [];
    public ?DeliveryType $deliveryType = null;

    public array $filterableSaved = [];
    protected array $rules = [
        'data.city_id' => 'required',
        'data.warehouse_id' => 'required',
    ];

    public function mount()
    {
        $this->initFilterable();
       // $this->initSavedAddresses();
    }

    public function render()
    {

        return view('livewire.order-meta-blocks.self-pickup-livewire', [
            'filterableMode' => $this->filterableMode,
        ]);
    }

    protected function onUpdatingFilterableCityValue($value)
    {
        if ($this->filterableCity['id']) {
            $this->emit('eventClearOrderDelivery');
        }
    }

    protected function onSetFilterableCity($id, $name)
    {
        $this->trySendAddress();
    }

    protected function onResetFilterableCity()
    {
        $this->trySendAddress();
    }

    protected function setFilterableCityList($value): array
    {

        $cities = $value
            ? City::query()->SearchByName($value)->limit(10)->get()
            : City::query()->RegionCapitals()->get();

        return $cities->keyBy('id')
            ->map(function ($c) {
                return [
                    'text' => $c->name_uk,
                    'title' => $c->name_uk . " ({$c->district_uk} {$c->region_uk})",
                ];
            })->toArray();

    }

    protected function getFullAddress(): string
    {
        return sprintf('%s, %s %s/%s, %s',
            $this->filterableCity['value'],
            $this->street,
            $this->house,
            $this->korpus,
            $this->office
        );
    }

    public function updated($field, $value)
    {
        $this->updatedFilterable($field, $value);
    }

    public function messages()
    {
       return [
            'data.city_id.required' => __('custom::site.choice_value_from_list'),
            'data.warehouse_id.required' => __('custom::site.choice_value_from_list'),
        ];
    }

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
    /////Заглушка = 0
        $this->data = [
            'warehouse_id' => $this->filterableWarehouse['id'],
            'city_id' => 1,
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
