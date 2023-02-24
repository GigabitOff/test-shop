<?php

namespace App\Http\Livewire\Forms\Customer;

use App\Models\City;
use App\Models\Contract;
use App\Models\User;
use App\Models\UserChange;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerEditLivewire extends Component
{
    public $leader;
    public $customer;
    public $changes;

    public $fio;
    public $city;
    public $city_id;
    public $cities = [];
    public $position;
    public $phone;
    public $phone_raw;
    public $email;
    public bool $is_admin = false;

    public array $contract_ids = [];
    public array $contracts = [];

//    public string $counterparty = '';
    public array $counterparty_ids = [];
    public array $counterparties = [];

    public ?string $payload_hash = '';

    public bool $mode_selecting_city = false;
    public bool $isUploadLazyContent = false;

    protected array $revalidateJsItems = [];

    public function updatedCity($value)
    {
        if (trim($value)) {
            $this->cities = City::query()->SearchByName($value)
                ->limit(10)->get()
                ->keyBy('id');
        } else {
            $this->cities = City::regionCapitals()->get()->keyBy('id');
        }
        $this->mode_selecting_city = true;
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/[^\d]/', '', $value);
    }

    public function updatedCounterpartyIds()
    {
        $this->initContracts();
        $this->updateContractIds();
    }

    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $exist = false;
            $changes = UserChange::where('user_id', $this->customer->id)->first()
                ?? new UserChange();

            if ($this->customer->name != $this->fio) {
                $changes->name = $this->fio;
                $exist = true;
            } else {
                $changes->name = null;
            }
            if ($this->customer->email != $this->email) {
                $changes->email = $this->email;
                $exist = true;
            } else {
                $changes->email = null;
            }
            if ($this->customer->phone != $this->phone) {
                $changes->phone = $this->phone;
                $exist = true;
            } else {
                $changes->phone = null;
            }

            if ($this->customer->city_id != $this->city_id
                && City::find($this->city_id ?? 0)) {
                $changes->city_id = $this->city_id;
                $exist = true;
            } else {
                $changes->city_id = null;
            }

            if ($this->customer->position != $this->position) {
                $changes->position = $this->position;
                $exist = true;
            } else {
                $changes->position = null;
            }

//            if (array_diff(
//                $this->contract_ids,
//                $this->customer->contractIds->toArray()
//            )) {
//                $changes->contract_ids = join(',', $this->contract_ids);
//                $exist = true;
//                //to-do: отправить сообщение что пользователь удален из этих контрактов
//                // только у менеджера, когда он промодерирует изменения
//                // возможно потребуется пререключение привязки заказов.
//            } else {
//                $changes->contract_ids = null;
//            }
            $this->customer->is_admin = $this->is_admin;
            $this->customer->save();

            if ($this->is_admin){
                $counterparty_ids = array_keys($this->counterparties);
                $this->customer->counterparties()->sync($counterparty_ids);

                $contract_ids = Contract::query()
                    ->whereIn('counterparty_id', $counterparty_ids);
                $this->customer->contracts()->sync($contract_ids);
            } else {
                $this->customer->counterparties()->sync($this->counterparty_ids);
                $this->customer->contracts()->sync($this->contract_ids);
            }

            if ($exist) {
                $changes->user_id = $this->customer->id;
                $changes->save();
                session()->flash('success', __('custom::site.personal_data_go_to_moderate'));
            } elseif($changes->user_id) {
                $changes->delete();
                session()->flash('success', __('custom::site.data_recovered'));
            } else {
                session()->flash('success', __('custom::site.data_saved'));
            }

            $this->changes = $changes;

            DB::commit();

            $this->emit('eventCustomerChanged');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('fail', __('custom::site.user_edit_fail'));
        }
    }

    public function selectCity($id)
    {
        $city = City::find($id ?? 0);
        if ($city) {
            $this->city_id = $id;
            $this->city = $city->name_uk;
        }

        $this->mode_selecting_city = false;

        $this->validateOnly('city_id');
    }

    public function render()
    {
        if ($this->revalidateJsItems) {
            $this->emit('revalidate', $this->uniqueJsItems($this->revalidateJsItems));
        }

        return view('livewire.forms.customer.customer-edit-livewire');
    }

    public function rules(): array
    {
        $rules = [
            'fio' => 'required',
            'phone' => 'required|min:12|unique:users,phone,' . $this->customer->id,
            'email' => 'required|unique:users,email,' . $this->customer->id,
            'city_id' => 'required',
        ];

        if (! $this->is_admin){
            $rules['counterparty_ids'] = 'required';
            $rules['contract_ids'] = 'required';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'phone.unique' => __('custom::site.user_phone_unique'),
            'email.unique' => __('custom::site.user_email_unique'),
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'counterparty_ids' => __('custom::site.counterparty'),
            'contract_ids' => __('custom::site.contract'),
        ];
    }


    public function uploadLazyContent($payload = null)
    {
        if ($payload && $this->payload_hash === base64_encode(json_encode($payload))) {
            return;
        }
        $this->payload_hash = base64_encode(json_encode($payload));

        $this->resetForm();
        $this->isUploadLazyContent = false;

        $this->customer = User::whereId((int)($payload['customer_id'] ?? 0))->first();
        if (!$this->customer || !$this->customer->isCustomerLegal) {
            $this->payload_hash = null;
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.user_add'),
                'message' => __('custom::site.form_load_error'),
                'state' => 'danger',
            ]);
            return;
        }

        $this->lazyInit();
        $this->isUploadLazyContent = true;
    }

    public function lazyInit()
    {
        $this->initCounterparties();
        $this->initContracts();

        $this->cities = City::regionCapitals()->get()->keyBy('id');

        $changes = UserChange::where('user_id', $this->customer->id)->first();

        $this->fio = $changes->name ?? $this->customer->name;
        $this->email = $changes->email ?? $this->customer->email;
        $this->phone = $changes->phone ?? $this->customer->phone;
        $this->position = $changes->position ?? $this->customer->position;
        $this->city = $changes->city->name_uk ?? $this->customer->city->name_uk ?? '';
        $this->city_id = $changes->city_id ?? $this->customer->city_id;
        $this->phone_raw = formatPhoneNumber($this->phone);
        $this->is_admin = $this->customer->is_admin;

        $this->changes = $changes ?? new UserChange();
    }

    public function initCounterparties()
    {
        $counterparty = $this->customer->counterparties()->first();
        $leader = $counterparty->founder;
        $this->counterparties = $leader->counterparties()
            ->onlyModerated()
            ->pluck('name', 'id')->toArray();

        if (!$this->customer->is_admin){
            $this->counterparty_ids = $this->customer->counterparties()->pluck('id')->toArray();
        }

        $this->revalidateJsCounterpartiesSelect();
    }

    public function initContracts()
    {
        if ($this->counterparty_ids){
            $this->contracts = Contract::query()
                ->whereIn('counterparty_id', $this->counterparty_ids)
                ->with('counterparty')
                ->select('id', 'registry_no', 'counterparty_id')
                ->get()->keyBy('id')
                ->map(function (Contract $contract) {
                    return $contract->registry_no . ' -- ' . $contract->counterparty->name;
                })
                ->toArray();

            $this->contract_ids = $this->customer->contracts()->pluck('id')->toArray();
        }

        $this->revalidateJsContractsSelect();
    }

    protected function updateContractIds()
    {
        $this->contract_ids = array_intersect( $this->contract_ids, array_keys($this->contracts));
    }

    public function resetForm()
    {
        $this->reset(['customer', 'city_id', 'city', 'position', 'phone_raw', 'phone', 'fio', 'email']);
        $this->clearValidation();
    }

    private function revalidateJsCounterpartiesSelect()
    {
        $this->revalidateJsItems['select2'][] =
            '#modal-customer-edit .select2-group select[name="counterparty"]';
    }

    private function revalidateJsContractsSelect()
    {
        $this->revalidateJsItems['select2'][] =
            '#modal-customer-edit .select2-group select[name="contract"]';
    }

    private function uniqueJsItems($data)
    {
        foreach ($data as &$item) {
            $item = array_unique($item);
        }
        return $data;
    }

}
