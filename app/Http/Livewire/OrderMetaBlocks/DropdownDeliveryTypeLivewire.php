<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Models\DeliveryType;
use Livewire\Component;

class DropdownDeliveryTypeLivewire extends Component
{
    public ?int $deliveryTypeId = 0;
    public string $deliveryTypeName = '';
    public array $deliveryTypeList = [];

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
        $this->deliveryTypeName = $this->deliveryTypeList[$id] ?? '';
        $this->emit('eventSetOrderDeliveryType', $id, $this->deliveryTypeName);
    }

    private function setDeliveryTypeList(): array
    {
        return DeliveryType::query()
            ->withTranslation()->get()
            ->keyBy('id')->map->name->toArray();
    }

}
