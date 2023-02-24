<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\City;
use App\Models\Contract;
use App\Models\DeliveryAddress;
use App\Models\DeliveryType;
use App\Services\DeliveryServices\SatService;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class SatLivewire extends Component
{
    use WithFilterableDropdown;

    // Данные передаются из внешнего компонента
    public ?int $deliveryAddressId = null;
    public ?Model $addressOwner;    // morph: Contract|User
    public ?DeliveryType $deliveryType = null;

    // локальные данные
    public array $data = [];

    public array $filterableSaved = [];
    public array $filterableDepartment = [];
    public array $filterableCity = [];

    // локальные данные
    public string $deliveryTarget = 'address';

    public ?string $street = null;
    public ?string $house = null;
    public ?string $korpus = null;
    public ?string $office = null;

    protected SatService $SatService;
    protected $listeners = [
        'eventSetOrderContract',
        'eventReceiveDeliveryDataSaved',
    ];

    public function boot(SatService $service)
    {
        $this->SatService = $service;
    }

    public function mount()
    {
        $this->initFilterable();
        $this->initSavedAddresses();
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.sat-livewire', [
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

    protected function onSetFilterableDepartment($id, $value)
    {
        $this->filterableDepartment['number'] = $this->filterableDepartment['list'][$id]['number'];
        $this->trySendAddress();
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

    public function rules(): array
    {
        if ($this->isTargetAddress()) {
            $rules = [
                'data.city_id' => 'required',
                'data.street_name' => 'required',
                'data.dom' => 'required',
            ];
        } else {
            $rules = [
                'data.otdel_guid' => 'required',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'data.city_id.required' => __('custom::site.choice_value_from_list'),
            'data.otdel_guid.required' => __('custom::site.choice_value_from_list'),
        ];
    }

    public function validationAttributes(): array
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
                'city_id' => $address->city_id ?? null,
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
                'city_id' => $this->filterableCity['id'],
                'city_name' => $this->filterableCity['value'],
                'street_name' => $this->street,
                'dom' => $this->house,
                'korpus' => $this->korpus,
                'office' => $this->office,
            ];
        } else {
            $this->data = [
                'otdel_guid' => $this->filterableDepartment['id'],
                'otdel_name' => $this->filterableDepartment['value'],
                'otdel_number' => $this->filterableDepartment['number'] ?? '',
            ];
        }
    }

    protected function isTargetAddress(): bool
    {
        return 'address' === $this->deliveryTarget;
    }

    protected function isTargetDepartment(): bool
    {
        return 'department' === $this->deliveryTarget;
    }

    protected function isDeliveryNew(): bool
    {
        return 'static' === ($this->filterableSaved['id'] ?: 'static');
    }

    protected function isDeliverySaved(): bool
    {
        return !$this->isDeliveryNew();
    }

    protected function isDeliveryNewToAddress(): bool
    {
        return $this->isDeliveryNew() && $this->isTargetAddress();
    }

    protected function isDeliveryNewToDepartment(): bool
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

    protected function setFilterableDepartmentList(): array
    {
        return $this->SatService->getWarehouses()
            ->keyBy('ref')
            ->map(function ($el) {
                return [
                    'text' => $el['description'],
                    'title' => "{$el['description']} {$el['address']}",
                    'number' => $el['number'],
                ];
            })
            ->toArray();
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
}
