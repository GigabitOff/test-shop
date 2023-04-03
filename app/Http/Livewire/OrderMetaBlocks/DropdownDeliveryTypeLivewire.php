<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Models\DeliveryType;
use Livewire\Component;
use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\DeliveryAddress;
use App\Models\Warehouse;

use App\Models\City;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Http\Request;

class DropdownDeliveryTypeLivewire extends Component
{
    public ?int $deliveryTypeId = 0;
    public string $deliveryTypeName = '';
    public array $deliveryTypeList = [];
    public ?int $paymentId = 0;


    public function mount()
    {
        $this->deliveryTypeList = $this->setDeliveryTypeList();
        $this->deliveryTypeName = $this->deliveryTypeList[$this->deliveryTypeId] ?? '';
    }

    public function render()
    {

    return view('livewire.order-meta-blocks.dropdown-delivery-type-livewire');

    }

    public function updatedDeliveryTypeId($id)
    {

        $this->ret = $this->paymentId;
        $this->deliveryTypeName = $this->deliveryTypeList[$id] ?? '';
        $this->emit('eventSetOrderDeliveryType', $id, $this->deliveryTypeName,  $this->ret);
    }

    private function setDeliveryTypeList(): array
    {

        return DeliveryType::query()
            ->withTranslation()->get()
            ->keyBy('id')->map->name->toArray();
    }


}
