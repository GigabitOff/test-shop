<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Models\User;
use App\Services\OrdersService;
use Livewire\Component;

class DropdownCounterpartyLivewire extends Component
{
    public ?int $customerId = 0;
    public ?int $counterpartyId = 0;
    public string $counterpartyKey = '';
    public string $counterpartyName = '';
    public array $counterpartyList = [];

    // Номер заказа, заполняется когда находимся на странице редактирования заказа.
    // Используется для разрешения изменения контрагента
    public int $editedOrderId = 0;

    protected $listeners = [
        'eventSetOrderCustomer',
        'eventSetEditedOrderId'
    ];

    public function mount()
    {
        $this->counterpartyList = $this->setCounterpartyList();
        $this->counterpartyName = $this->counterpartyList[$this->counterpartyId] ?? '';
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.dropdown-counterparty-livewire');
    }

    public function updatedCounterpartyKey($key)
    {
        $id = (int)$key;

        if ($id == $this->counterpartyId){
            return;
        }

        $service = app()->make(OrdersService::class);

        $rejected = [];
        if ($service->canSetEditedOrderCounterparty($this->editedOrderId, $id, $rejected)) {
            $this->counterpartyId = $id;
            $this->counterpartyName = $this->counterpartyList[$key] ?? '';
            $this->emit('eventSetOrderCounterparty', $id, $this->counterpartyName);
        } else {
            $this->counterpartyName = $this->counterpartyList[$this->counterpartyId] ?? '';

            $this->dispatchBrowserEvent('flashMessage', [
                'title'=> __('custom::site.edit_order'),
                'message'=> sprintf(__('custom::site.info_messages.order_edited_set_counterparty_error'), implode(', ', $rejected)),
                'state'=> 'warning'
            ]);
        }
    }

    public function eventSetOrderCustomer($id)
    {
        $this->customerId = User::whereId($id)->exists() ? $id : 0;
        $this->counterpartyList = $this->setCounterpartyList();
        $this->counterpartyName = '';
    }

    public function eventSetEditedOrderId($orderId)
    {
        $this->editedOrderId = $orderId;
    }

    private function setCounterpartyList(): array
    {
        $customer = (auth()->id() === $this->customerId)
            ? auth()->user()
            : User::find($this->customerId);

        return $customer->counterparties()
            ->onlyModerated()
            ->pluck('name', 'id')
            ->toArray();
    }
}
