<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\City;
use App\Models\ShopCity;
use App\Models\ShopCityTranslation;
use App\Models\Contract;
use App\Models\DeliveryAddress;
use App\Models\DeliveryType;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class AddressDeliveryLivewire extends Component
{
    use WithFilterableDropdown;

    // Данные передаются из внешнего компонента
    public ?int $deliveryAddressId = null;
    public ?Model $addressOwner;    // morph: Contract|User
    public ?DeliveryType $deliveryType = null;

    // локальные данные
    public array $data = [];

    public array $filterableSaved = [];
    public array $filterableCity = [];
    public string $addressFull = '';
    public string $departureAt = '';

    public ?string $street = null;
    public ?string $house = null;
    public ?string $korpus = null;
    public ?string $office = null;
    public string $re = '12345';

    public ?bool $flagDataCreateOrder = false;


    protected $listeners = [
        'eventSetOrderContract',
        'eventReceiveDeliveryDataSaved',
    ];

    protected array $rules = [
        'data.city_id' => 'required',
        'data.street_name' => 'required',
        'data.dom' => 'required',
    ];


    public function mount()
    {
        //no
        $this->initFilterable();
        $this->initSavedAddresses();
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.address-delivery-livewire', [
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updated($field, $value)
    {

        $this->updatedFilterable($field, $value);

        if (in_array($field, ['addressFull','street', 'house', 'korpus','office', 'departureAt'])) {
            $this->addressFull = sprintf('%s %s/%s, %s',
                $this->street,
                $this->house,
                $this->korpus,
                $this->office
            );
            $this->trySendAddress();
        }
    }

    protected function onSetFilterableSaved($id, $value)
    {
     //no
        if ($this->isDeliverySaved()) {
            $this->updateDataFromSaved($id);
        } else {
            $this->reset('data');
        }

       $this->trySendAddress();
    }

    protected function onResetFilterableSaved()
    {
       //no
        $this->emit('eventClearOrderDelivery');
    }

    protected function onUpdatingFilterableCityValue($value)
    {
       //no
        if ($this->filterableCity['id']) {
            $this->emit('eventClearOrderDelivery');
        }
    }

    protected function onSetFilterableCity($id, $name)
    {
        //// При выборе города при Доставка по городу

        $this->trySendAddress();
    }

    protected function onResetFilterableCity()
    {

        $this->trySendAddress();
    }

    public function messages(): array
    {
        return [
           'data.city_id.required' => __('custom::site.choice_value_from_list'),
        ];
    }

    public function validationAttributes(): array
    {
       //no
        return [
            'data.address_full' => __('custom::site.address'),
           'data.street_name' => __('custom::site.street'),
            'data.dom' => __('custom::site.house'),
            'data.korpus' => __('custom::site.house_item'),
            'data.office' => __('custom::site.office_flat'),
        ];
    }

    /** Event Handlers */
    public function eventSetOrderContract($id, $name)
    {
       //no
        if ($contract = Contract::find((int)$id)) {
            $this->addressOwner = $contract;
            $this->reset('deliveryAddressId');
            $this->resetFilterable('filterableSaved');
            $this->initSavedAddresses();
            if ($this->filterableSaved['id']){
                // Для случая когда выбран вариант по умолчанию
                $this->trySendAddress();
            }
        }
    }

    public function eventReceiveDeliveryDataSaved()
    {
       //no
        if ($this->isDeliverySaved()) {
            $this->emit('eventSetOrderDeliveryData', $this->data);
        }
    }

    /** Service Functions */
    protected function trySendAddress()
    {
        //no
        if ($this->isDeliveryNew()) {
            $this->updateDataFromValues();
            try {
               // $this->validate();
            } catch (\Exception $e) {
                $this->emit('eventClearOrderDelivery');
                throw $e;
            }
        }

        $this->emit('eventSetOrderDeliveryData', $this->data);
    }

    protected function initSavedAddresses()
    {
       //no
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
        //no
        if ($address = DeliveryAddress::find($id)) {
            $this->data = [
                'delivery_id' => $id,
                'city_id' => $address->city_id ?? '',
                'city_name' => $address->city->name_uk ?? '',
                'address_full' => $address->address_full ?? '',
                'street_name' => $address->street_name ?? null,
                'dom' => $address->dom ?? null,
                'korpus' => $address->korpus ?? null,
                'office' => $address->office ?? null,
                'departure_at' => formatDate($address->departure_at ?? ''),
            ];
        }
    }

    protected function updateDataFromValues()
    {
    //no
        $this->data = [
            'city_id' => $this->filterableCity['id'],
            'city_name' => $this->filterableCity['value'],
            'address_full' => $this->getFullAddress(),
            'street_name' => $this->street,
            'dom' => $this->house,
            'korpus' => $this->korpus,
            'office' => $this->office,
            'departure_at' => $this->departureAt,
        ];
    }

    protected function setFilterableSavedList(): array
    {
      //no
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

    /*protected function setFilterableCityList($value): array
    {
        $cities = $value
            ? City::query()->SearchByName($value)->get()
            : City::query()->RegionCapitals()->get();

        return $cities->keyBy('id')
            ->map(function ($c) {
                return [
                    'text' => $c->name_uk,
                    'title' => $c->name_uk . " ({$c->district_uk} {$c->region_uk})",
                ];
            })->toArray();
    }*/

    protected function setFilterableCityList(): array
    {
        $cities =  ShopCity::query()->RegionCapitals()->get();
        $citiesT =  ShopCityTranslation::query()->RegionCapitals()->get();

        $filteredCities = [];

        foreach ($citiesT as $cityT) {
            $city = $cities->where('id', $cityT->city_id)->first();
            if ($city && $cityT->locale === app()->getLocale()) {
                $filteredCities[] = [
                    'text' => $cityT->title,
                    'title' => $city->id,
                    'locale' => $cityT->locale,
                ];
            }
        }

        return $filteredCities;
    }

    protected function isDeliveryNew(): bool
    {
        return 'static' === ($this->filterableSaved['id'] ?: 'static');
    }

    protected function isDeliverySaved(): bool
    {
        return !$this->isDeliveryNew();
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

}
