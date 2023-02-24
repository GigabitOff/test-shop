<?php

namespace App\Http\Livewire\Forms;

use App\Models\Contract;
use App\Models\Counterparty;
use Livewire\Component;

class CustomerConnectLivewire extends Component
{

    public int $contract_id = 0;
    public array $customer_ids = [];
    public array $customers = [];

    public bool $isUploadLazyContent = false;

    protected array $revalidateJsItems = [];

    public function render()
    {
        if ($this->revalidateJsItems) {
            $this->emit('revalidate', $this->uniqueJsItems($this->revalidateJsItems));
        }

        return view('livewire.forms.customer-connect-livewire');
    }

    public function submit()
    {
        $this->validate();

        if ($this->customer_ids){
            $contract = Contract::find($this->contract_id);
            $contract->customers()->syncWithoutDetaching($this->customer_ids);

            $this->emit('eventCustomerConnected', $this->contract_id);
        }
    }

    public function rules(): array
    {
        return [
            'customer_ids' => 'required',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'contract_ids' => __('custom::site.contract'),
        ];
    }

    public function uploadLazyContent($payload = null)
    {
        $this->restoreForm();
        $this->isUploadLazyContent = false;

        $this->contract_id = Contract::whereId((int)($payload['contract_id'] ?? 0))->value('id') ?? 0;
        if (!$this->contract_id) {
            $this->payload_hash = null;
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.connect_customer'),
                'message' => __('custom::site.form_load_error'),
                'state' => 'danger',
            ]);
            return;
        }

        $this->lazyInitCustomers();

        if (!$this->customers){
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.connect_customer'),
                'message' => __('custom::site.connect_customers_empty'),
                'state' => 'danger',
            ]);
            return;
        }

        $this->isUploadLazyContent = true;

        $this->revalidateJsCustomersSelect();

    }

    public function lazyInitCustomers()
    {
        $counterparty = Counterparty::query()
            ->whereRelation('contracts', 'id', '=', $this->contract_id)
            ->first();
        $this->customers = $counterparty->users()
            ->whereDoesntHave('contracts', fn($q) => $q->whereId($this->contract_id))
            ->withTranslation()
            ->select('id')
            ->get()->keyBy('id')
            ->map->name->toArray();
    }

    public function restoreForm()
    {
        $this->reset(
            [
                'customers',
                'customer_ids',
            ]
        );

        $this->clearValidation();
    }


    private function revalidateJsCustomersSelect()
    {
        $this->revalidateJsItems['select2'][] =
            '#modal-customer-add .select2-group select[name="contract"]';
    }

    private function uniqueJsItems($data)
    {
        foreach ($data as &$item) {
            $item = array_unique($item);
        }
        return $data;
    }


}
