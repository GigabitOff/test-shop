<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\User;
use Livewire\Component;

class DropdownCustomerLivewire extends Component
{
    use WithFilterableDropdown;

    public int $customerId = 0;
    public array $filterableCustomer = [];

    protected ?User $manager;
    protected $queryString = [
        'customerId' => ['except' => 0],
    ];

    public function boot()
    {
        $this->manager = auth()->user();
    }

    public function mount()
    {
        $this->initFilterable();
        $this->revalidate();
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.dropdown-customer-livewire', [
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updated($field, $value)
    {
        $this->updatedFilterable($field, $value);
    }

    private function revalidate()
    {
        if ($this->customerId && $customer = User::find($this->customerId)) {
            $this->filterableCustomer['id'] = $customer->id;
            $this->filterableCustomer['value'] = $customer->name;
        }
    }

    private function setFilterableCustomerList($value): array
    {
        if (!$value) {
            return [];
        }

        $customers = $this->manager->customers()
            ->withTranslation()
            ->with('counterparty:id,name')
            ->where(function ($q) use ($value) {
                $q->whereTranslationLike('name', "%{$value}%")
                    ->orWhereDigitFieldLike('phone', "%{$value}%");
            })
            ->take(10)->select('id', 'phone', 'counterparty_id')
            ->get()->keyBy('id')
            ->map(function (User $customer) {
                return "$customer->name ({$customer->phone})";
            })->toArray();

        if (!$customers) {
            $customers = [
                0 => __('custom::site.create_customer'),
            ];
        }

        return $customers;
    }

    protected function onResetFilterable($key)
    {
        $this->customerId = 0;
        $this->emit('eventSetOrderCustomer', 0);
    }

    protected function onSetFilterable($key, $id, $name)
    {
        if ($customer = User::find($id)) {
            $this->customerId = $id;
            $this->filterableCustomer['value'] = $customer->name;
            $this->emit('eventSetOrderCustomer', $id);
        } else {
            $this->onResetFilterable($key);
            if (0 == $id) {
                $this->filterableCustomer['value'] = '';
                $this->dispatchBrowserEvent('showAddNewCustomerModal', ['managerId' => $this->manager->id ?? 0]);
            }
        }
    }
}
