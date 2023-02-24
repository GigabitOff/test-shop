<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\Contract;
use App\Models\DeliveryAddress;
use App\Models\DeliveryType;
use App\Services\DeliveryServices\DeliveryAutoService;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class DeliveryAutoLivewire extends Component
{
    use WithFilterableDropdown;

    // Данные передаются из внешнего компонента
    public ?int $deliveryAddressId = null;
    public ?Model $addressOwner;    // morph: Contract|User
    public ?DeliveryType $deliveryType = null;

    // локальные данные
    public array $data = [];

    public array $filterableSaved = [];
    public array $filterableRegion = [];
    public array $filterableLocation = [];
    public array $filterableDepartment = [];

    public string $deliveryTarget = 'address';

    public ?string $street = null;
    public ?string $house = null;
    public ?string $korpus = null;
    public ?string $office = null;

    protected DeliveryAutoService $deliveryAutoService;
    protected $listeners = [
        'eventSetOrderContract',
        'eventReceiveDeliveryDataSaved',
    ];

    public function boot(DeliveryAutoService $service)
    {
        $this->deliveryAutoService = $service;
    }

    public function mount()
    {
        $this->initFilterable();
        $this->initSavedAddresses();
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.delivery-auto-livewire', [
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updated($field, $value)
    {
        $this->updatedFilterable($field, $value);

        if (in_array($field, ['deliveryTarget', 'street', 'house', 'korpus', 'office'])) {
            $this->trySendAddress();
        }
    }

    protected function onSetFilterableSaved($id, $value)
    {
        if ($this->isDeliverySaved()) {
            $this->updateDataFromSaved($id);
        } else {
            $this->reset('data');
        }

        $this->trySendAddress();
    }

    protected function onResetFilterableSaved()
    {
        $this->emit('eventClearOrderDelivery');
    }

    protected function onSetFilterableRegion($id, $value)
    {
        $this->resetFilterable('filterableLocation');
        $this->resetFilterable('filterableDepartment');
        $this->filterableLocation['list'] = $this->setFilterableLocationList($id);
        $this->trySendAddress();
    }

    protected function onSetFilterableLocation($id, $value)
    {
        $this->resetFilterable('filterableDepartment');
        $this->filterableDepartment['list'] = $this->setFilterableDepartmentList($id);
        $this->trySendAddress();
    }

    protected function onSetFilterableDepartment($id, $value)
    {
        $this->filterableDepartment['number'] = $this->filterableDepartment['list'][$id]['number'] ?? null;
        $this->trySendAddress();
    }

    public function rules()
    {
        if ('address' === $this->deliveryTarget) {
            $rules = [
                'filterableRegion.id' => 'required',
                'data.city_guid' => 'required',
                'data.street_name' => 'required',
                'data.dom' => 'required',
            ];
        } else {
            $rules = [
                'filterableRegion.id' => 'required',
                'data.otdel_guid' => 'required',
                'data.city_guid' => 'required',
            ];
        }

        if ($this->isDeliverySaved()) {
            unset($rules['regionId']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'filterableRegion.id.required' => __('custom::site.choice_value_from_list'),
            'data.city_guid.required' => __('custom::site.choice_value_from_list'),
            'data.otdel_guid.required' => __('custom::site.choice_value_from_list'),
        ];
    }

    public function validationAttributes()
    {
        return [
            'data.street_name' => __('custom::site.street'),
            'data.dom' => __('custom::site.house'),
            'data.korpus' => __('custom::site.house_item'),
            'data.office' => __('custom::site.office_flat'),
        ];
    }

    /** Event Handlers */
    public function eventSetOrderContract($id, $name)
    {
        if ($contract = Contract::find((int)$id)) {
            $this->addressOwner = $contract;
            $this->reset('deliveryAddressId', 'deliveryTarget');
            $this->resetFilterable('filterableSaved');
            $this->initSavedAddresses();
            if ($this->filterableSaved['id']) {
                // Для случая когда выбран вариант по умолчанию
                $this->trySendAddress();
            }
        }
    }

    public function eventReceiveDeliveryDataSaved()
    {
        if ($this->isDeliverySaved()) {
            $this->emit('eventSetOrderDeliveryData', $this->data);
        }
    }


    /** Service Functions */
    protected function trySendAddress()
    {
        if ($this->isDeliveryNew()) {
            $this->updateDataFromValues();

            try {
                $this->validate();
            } catch (\Exception $e) {
                $this->emit('eventClearOrderDelivery');
                throw $e;
            }
        }

        $this->emit('eventSetOrderDeliveryData', $this->data);
    }

    protected function initSavedAddresses()
    {
        $savedId = 0;
        if ($this->deliveryAddressId) {
            $savedId = $this->deliveryAddressId;
        } elseif (count($this->filterableSaved['list']) === 1) {
            $savedId = array_keys($this->filterableSaved['list'])[0];
        }

        if ($savedId) {
            $this->updateDataFromSaved($savedId);

            if ($value = $this->filterableSaved['list'][$savedId] ?? 0) {
                $this->filterableSaved['id'] = $savedId;
                $this->filterableSaved['value'] = $value;
            }
        }
    }

    protected function updateDataFromSaved($id)
    {
        if ($address = DeliveryAddress::find($id)) {
            $this->data = [
                'delivery_id' => $id,
                'street_name' => $address->street_name ?? null,
                'dom' => $address->dom ?? null,
                'korpus' => $address->korpus ?? null,
                'office' => $address->office ?? null,
                'city_guid' => $address->city_guid ?? null,
                'city_name' => $address->city_name ?? null,
                'otdel_guid' => $address->otdel_guid ?? null,
                'otdel_number' => $address->otdel_number ?? null,
                'otdel_name' => $address->otdel_name ?? null,
            ];

            $this->deliveryTarget = $this->data['otdel_guid']
                ? 'department'
                : 'address';
        }
    }

    protected function updateDataFromValues()
    {
        if ('address' === $this->deliveryTarget) {
            $this->data = [
                'city_guid' => $this->filterableLocation['id'],
                'city_name' => $this->filterableLocation['value'],
                'street_name' => $this->street,
                'dom' => $this->house,
                'korpus' => $this->korpus,
                'office' => $this->office,
            ];
        } else {
            $this->data = [
                'city_guid' => $this->filterableLocation['id'],
                'city_name' => $this->filterableLocation['value'],
                'otdel_guid' => $this->filterableDepartment['id'],
                'otdel_name' => $this->filterableDepartment['value'],
                'otdel_number' => $this->filterableDepartment['number'] ?? '',
            ];
        }
    }

    public function isTargetAddress(): bool
    {
        return 'address' === $this->deliveryTarget;
    }

    public function isTargetDepartment(): bool
    {
        return 'department' === $this->deliveryTarget;
    }

    public function isDeliveryNew(): bool
    {
        return 'static' === ($this->filterableSaved['id'] ?: 'static');
    }

    public function isDeliverySaved(): bool
    {
        return !$this->isDeliveryNew();
    }

    public function isDeliveryNewToAddress(): bool
    {
        return $this->isDeliveryNew() && $this->isTargetAddress();
    }

    public function isDeliveryNewToDepartment(): bool
    {
        return $this->isDeliveryNew() && $this->isTargetDepartment();
    }

    protected function setFilterableSavedList(): array
    {
        if ($this->deliveryType && $this->addressOwner) {
            $saved = $this->addressOwner->deliveryAddresses()
                ->where('delivery_type_id', $this->deliveryType->id)
                ->with(['deliveryType'])
                ->get()->keyBy('id')
                ->map(function ($el) {
                    return $el->formatFullAddress();
                })->filter()->toArray();
        }

        return $saved ?? [];
    }

    protected function setFilterableRegionList(): array
    {
        return $this->deliveryAutoService->getRegions()
            ->keyBy('code')->map->description->toArray();
    }

    protected function setFilterableLocationList($regionId): array
    {
        return $regionId
            ? $this->deliveryAutoService->getCities($regionId)
                ->keyBy('ref')->map->description->toArray()
            : [];
    }

    protected function setFilterableDepartmentList($locationId): array
    {
        return $locationId
            ? $this->deliveryAutoService->getWarehouses($locationId)
                ->keyBy('ref')
                ->map(function ($d) {
                    return [
                        'text' => $d['description'],
                        'title' => "{$d['description']} {$d['address']}",
                    ];
                })->toArray()

            : [];
    }

}
