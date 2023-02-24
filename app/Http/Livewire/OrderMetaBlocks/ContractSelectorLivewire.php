<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\User;
use Livewire\Component;

class ContractSelectorLivewire extends Component
{
    use WithFilterableDropdown;

    public User $customer;

    public array $filterableContract = [];

    public ?int $counterpartyId = 0;
    public ?int $contractId = 0;

    protected $listeners = [
        'eventSetOrderCounterparty'
    ];

    protected array $rules = [
        'filterableContract.id' => 'required|accepted'
    ];

    public function mount()
    {
        $this->initFilterable();
        if ($this->contractId && !empty($this->filterableContract['list'][$this->contractId])){
            $this->filterableContract['id'] = $this->contractId;
            $this->filterableContract['value'] = $this->filterableContract['list'][$this->contractId];
        }
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.contract-selector-livewire', [
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updated($filed, $value)
    {
        $this->updatedFilterable($filed, $value);

        $this->validateOnly('filterableContract.id');
    }

    public function messages(): array
    {
        return [
            'filterableContract.id|accepted' => __('custom::site.choice_value_from_list'),
        ];
    }

    public function eventSetOrderCounterparty($id, $name)
    {
        if ($this->counterpartyId != $id) {
            $this->counterpartyId = (int)$id;
            $this->resetFilterable('filterableContract');
        }
    }

    protected function setFilterableContractList(): array
    {
        return $this->counterpartyId
            ? $this->customer->contracts()
                ->whereRelation('counterparty', 'id', '=', $this->counterpartyId)
                ->pluck('registry_no', 'id')
                ->toArray()
            : [];
    }

    protected function onSetFilterableContract($id, $name)
    {
        $this->emit('eventSetOrderContract', $id, $name);
    }

    protected function onResetFilterableContract()
    {
        $this->emit('eventSetOrderContract', 0, '');
    }

}
