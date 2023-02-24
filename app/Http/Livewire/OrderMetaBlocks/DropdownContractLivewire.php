<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Models\Contract;
use App\Models\User;
use Livewire\Component;

class DropdownContractLivewire extends Component
{
    public ?int $customerId = 0;
    public ?int $contractId = 0;
    public string $contractKey = '';
    public string $contractName = '';
    public array $contractList = [];

    protected $listeners = [
        'eventSetOrderCustomer'
    ];

    public function mount()
    {
        $this->contractList = $this->setContractList();
        $this->contractName = $this->contractList[$this->contractId] ?? '';
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.dropdown-contract-livewire');
    }

    public function updatedContractKey($key)
    {
        // восстанавливаем числовой id из строкового ключа
        $id = (int)$key;
        $this->contractId = $id;
        $this->contractName = $this->contractList[$key] ?? '';
        $this->emit('eventSetOrderContract', $id, $this->contractName);
    }

    public function eventSetOrderCustomer($id)
    {
        $this->customerId = User::whereId($id)->exists() ? $id : 0;
        $this->contractList = $this->setContractList();
        $this->contractName = '';
    }

    private function setContractList(): array
    {
        $customer = (auth()->id() === $this->customerId)
            ? auth()->user()
            : User::find($this->customerId);

        $list = Contract::query()
            ->with('counterparty')
            ->whereRelation('customers', 'id', $this->customerId)
            ->whereHas('counterparty', function($query){
                $query->whereRelation('users', 'id', '=', $this->customerId);
            })
            ->select(['id', 'registry_no', 'counterparty_id'])
            ->get()
            ->each(function(Contract $c) use($customer){
                $c->phys = $c->counterparty_id === ($customer->counterparty_phys_id ?? 0);
            })
            ->sortByDesc('phys')
            ->keyBy('id')
            ->map(function (Contract $c) {
                return $c->phys
                    ? __('custom::site.phys_entity')
                    : $c->registry_no . ' -- ' . $c->counterparty->name;
            })
            ->toArray();

        // Обновляем ключи массива делая их строками
        // Это необходимо т.к. livewire переупорядочивает массивы с числовыми ключами
        // и таким образом сбрасывает сортировку по значению.
        $newList = [];
        foreach ($list as $key => $value){
            $newList["{$key}_"] = $value;
        }

        return $newList;
    }
}
