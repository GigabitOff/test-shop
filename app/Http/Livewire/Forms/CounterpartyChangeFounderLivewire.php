<?php

namespace App\Http\Livewire\Forms;

use App\Models\Contract;
use App\Models\Counterparty;
use App\Models\User;
use Livewire\Component;

class CounterpartyChangeFounderLivewire extends Component
{

    public ?Counterparty $counterparty = null;
    public ?int $customerId = null;
    public array $customerList = [];


    public bool $isUploadLazyContent = false;

    protected array $revalidateJsItems = [];

    public function render()
    {
        if ($this->revalidateJsItems) {
            $this->emit('revalidate', $this->uniqueJsItems($this->revalidateJsItems));
        }

        return view('livewire.forms.counterparty-change-founder-livewire');
    }

    public function submit()
    {
        $this->validate();

        /** @var User $newFounder */
        $newFounder = User::query()
            ->whereId($this->customerId)
            ->where('is_admin', true)
            ->whereRelation('counterparties', 'id', '=', $this->counterparty->id)
            ->first();

        if ($newFounder && $newFounder->id !== $this->counterparty->founder_id){
            $oldFounder = $this->counterparty->founder;

            $counterpartyIds = $oldFounder->counterparties()->pluck('id');
            $contractIds = Contract::query()
                ->whereIn('counterparty_id', $counterpartyIds)
                ->pluck('id');
            $oldFounder->counterparties()->update(['founder_id' => $newFounder->id]);
            $oldFounder->save();
            $newFounder->counterparties()->sync($counterpartyIds);
            $newFounder->contracts()->sync($contractIds);

            $this->emit('eventCounterpartyFounderChanged');
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.change_founder'),
                'message' => __('custom::site.change_founder_success'),
                'state' => 'success',
            ]);
            return;
        }
        $this->dispatchBrowserEvent('flashMessage', [
            'title' => __('custom::site.change_founder'),
            'message' => __('custom::site.change_founder_false'),
            'state' => 'warning',
        ]);
    }

    public function rules(): array
    {
        return [
            'customerId' => 'required',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'customerId' => __('custom::site.customer'),
        ];
    }

    public function uploadLazyContent($payload = null)
    {
        $this->restoreForm();
        $this->isUploadLazyContent = false;

        $this->counterparty = Counterparty::find((int)($payload['counterparty_id'] ?? 0));
        if (!$this->counterparty) {
            $this->payload_hash = null;
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.change_founder'),
                'message' => __('custom::site.form_load_error'),
                'state' => 'danger',
            ]);
            return;
        }

        $this->lazyInitCustomers();

        if (!$this->customerList){
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.change_founder'),
                'message' => __('custom::site.counterparty_admins_empty'),
                'state' => 'danger',
            ]);
            return;
        }

        $this->isUploadLazyContent = true;

        $this->revalidateJsCustomersSelect();

    }

    public function lazyInitCustomers()
    {
        $founder = $this->counterparty->founder;
        $this->customerId = $founder->id;
        $this->customerList = $founder->customers()
            ->where('is_admin', true)
            ->withTranslation()
            ->select('id')
            ->get()->keyBy('id')
            ->map->name->toArray();
    }

    public function restoreForm()
    {
        $this->reset(
            [
                'customerId',
                'customerList',
            ]
        );

        $this->clearValidation();
    }


    private function revalidateJsCustomersSelect()
    {
        $this->revalidateJsItems['nice_select'][] =
            '#modal-change-founder select[name="customerId"]';
    }

    private function uniqueJsItems($data)
    {
        foreach ($data as &$item) {
            $item = array_unique($item);
        }
        return $data;
    }


}
