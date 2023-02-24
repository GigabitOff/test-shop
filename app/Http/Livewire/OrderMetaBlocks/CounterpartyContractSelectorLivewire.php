<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\User;
use Livewire\Component;

class CounterpartyContractSelectorLivewire extends Component
{
    use WithFilterableDropdown;

    public User $customer;

    public array $filterableCounterparty = [];
    public array $filterableContract = [];

    public function mount()
    {
        $this->initFilterable();
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.counterparty-contract-selector-livewire', [
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updated($filed, $value)
    {
        $this->updatedFilterable($filed, $value);
    }

    protected function setFilterableCounterpartyList(): array
    {
        return $this->customer->counterparties()
            ->whereHas('contracts', function($q){
                $q->whereRelation('customers', 'id', '=', $this->customer->id);
            })
            ->pluck('name', 'id')
            ->toArray();

    }

    protected function onSetFilterableCounterparty()
    {
        $this->filterableContract['list'] = $this->setFilterableContractList();
    }

    protected function onResetFilterableCounterparty()
    {
        $this->resetFilterable('filterableContract');
        $this->emit('eventSetOrderContract', 0, '');
    }

    protected function setFilterableContractList(): array
    {
        return !empty($this->filterableCounterparty['id'])
            ? $this->customer->contracts()
                ->whereRelation('counterparty', 'id', '=', $this->filterableCounterparty['id'])
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
