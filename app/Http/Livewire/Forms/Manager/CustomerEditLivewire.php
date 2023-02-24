<?php

namespace App\Http\Livewire\Forms\Manager;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\City;
use App\Models\Counterparty;
use App\Models\User;
use App\Models\UserChange;
use App\Services\UsersService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerEditLivewire extends Component
{
    use WithFilterableDropdown;

    public $leader;
    public ?User $customer = null;
    public $changes;

    public $fio;
    public $city;
    public $city_id;
    public $cities = [];
    public $position;
    public $phone;
    public $phone_raw;
    public $email;

//    public array $contract_ids = [];
//    public array $contract_list = [];
    public array $counterparty_ids = [];
    public array $counterparty_list = [];
    public bool $is_admin = false;

    public array $counterparty_ids_cache = [];  // temporary saved when toggled is_admin
//    public array $contract_ids_cache = [];  // temporary saved when toggled is_admin

    public array $filterableCounterparty = [];

    public ?string $payload_hash = null;

    public bool $mode_selecting_city = false;
    public bool $isUploadLazyContent = false;

    protected array $revalidateJsItems = [];

    public function mount()
    {
        $this->initFilterable();
    }

    public function render()
    {
        if ($this->revalidateJsItems) {
            $this->emit('revalidate', $this->uniqueJsItems($this->revalidateJsItems));
        }

        return view('livewire.forms.manager.customer-edit-livewire', [
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updated($field, $value)
    {
        $this->updatedFilterable($field, $value);
    }

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

    public function updatedIsAdmin($value)
    {
        if ($value) {
            $this->counterparty_ids_cache = $this->counterparty_ids;
            $this->counterparty_ids = array_keys($this->counterparty_list);
        } else {
            $this->counterparty_ids = $this->counterparty_ids_cache;
        }

        $this->revalidateJsCounterpartiesSelect();
    }

    public function submit(UsersService $service)
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $changes = UserChange::where('user_id', $this->customer->id)->first();

            $this->customer->name = $this->fio;
            $this->customer->email = $this->email;
            if ($this->customer->phone != $this->phone) {
                $this->customer->phone = $this->phone;
                $this->customer->phone_verified = null;
            }
            if ($this->customer->city_id != $this->city_id
                && City::find($this->city_id ?? 0)) {
                $this->customer->city_id = $this->city_id;
            }

            if ($this->customer->isCustomerLegal) {
                $this->customer->position = $this->position;

                if (!$this->counterparty_ids) {
                    // Отключаем всех контрагентов и контракты
                    // переводим в статус обычного ползователя.
                    $service->detachLegalPermanently($this->customer);
                } else {
                    $this->customer->counterparties()->sync($this->counterparty_ids);
                }
            } elseif ($this->customer->isCustomerSimple && $this->filterableCounterparty['id']) {
                $this->customer->syncRoles(['legal']);
                $this->customer->counterparties()->attach($this->filterableCounterparty['id']);
            }

            $this->customer->save();

            if (!empty($changes->user_id)) {
                $changes->delete();
            }
            session()->flash('success', __('custom::site.data_saved'));

            $this->changes = $changes ?? new UserChange();

            DB::commit();

            $this->revalidateProps();
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


    public function rules(): array
    {
        $rules = [
            'fio' => 'required',
            'phone' => 'required|min:12|unique:users,phone,' . $this->customer->id,
            'email' => 'required|unique:users,email,' . $this->customer->id,
            'city_id' => 'required',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'phone.unique' => __('custom::site.user_phone_unique'),
            'email.unique' => __('custom::site.user_email_unique'),
        ];
    }

    public function uploadLazyContent($payload = null)
    {
//        if ($payload && $this->payload_hash === base64_encode(json_encode($payload))) {
//            return;
//        }
//        $this->payload_hash = base64_encode(json_encode($payload));

        $this->isUploadLazyContent = false;

        $this->customer = User::find((int)($payload['customer_id'] ?? 0));
        if (!$this->customer) {
            $this->payload_hash = null;
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.user_add'),
                'message' => __('custom::site.form_load_error'),
                'state' => 'danger',
            ]);
            return;
        }

//        if ($this->customer->isCustomerLegal) {
//            $this->leader = $this->customer->counterparties()->first()->leader;
//            if (!$this->leader) {
//                $this->payload_hash = null;
//                $this->dispatchBrowserEvent('flashMessage', [
//                    'title' => __('custom::site.user_add'),
//                    'message' => __('custom::site.form_load_error'),
//                    'state' => 'danger',
//                ]);
//                return;
//            }
//        } else {
//            $this->leader = $this->customer;
//        }

        $this->revalidateProps();
        $this->isUploadLazyContent = true;
    }

    protected function revalidateProps()
    {
        $this->resetForm();

        if ($this->customer->isCustomerLegal) {
            $this->is_admin = $this->customer->is_admin;
            $this->initCounterparties();
        }

        $this->cities = City::regionCapitals()->get()->keyBy('id');

        $changes = UserChange::where('user_id', $this->customer->id)->first();

        $this->fio = $changes->name ?? $this->customer->name;
        $this->email = $changes->email ?? $this->customer->email;
        $this->phone = $changes->phone ?? $this->customer->phone;
        $this->position = $changes->position ?? $this->customer->position;
        $this->city = $changes->city->name_uk ?? $this->customer->city->name_uk ?? '';
        $this->city_id = $changes->city_id ?? $this->customer->city_id;
        $this->phone_raw = formatPhoneNumber($this->phone);

        $this->changes = $changes ?? new UserChange();
    }

    public function initCounterparties()
    {
        $counterparty = $this->customer->counterparties()->first();
        $this->leader = $counterparty->founder ?? $this->customer;
        $this->counterparty_list = $this->leader->counterparties()
            ->onlyModerated()
            ->pluck('name', 'id')->toArray();

        if (!$this->customer->is_admin) {
            $this->counterparty_ids = $this->customer->counterparties()->pluck('id')->toArray();
        }

        $this->revalidateJsCounterpartiesSelect();
    }


    public function resetForm()
    {
        $this->reset([
            'city_id',
            'city',
            'position',
            'phone_raw',
            'phone',
            'fio',
            'email',
            'mode_selecting_city',
            'counterparty_ids',
            'counterparty_list',
            'is_admin',
            'counterparty_ids_cache',
        ]);
        $this->resetFilterable('filterableCounterparty');
        $this->clearValidation();
    }

    private function revalidateJsCounterpartiesSelect()
    {
        $this->revalidateJsItems['select2'][] =
            '#modal-customer-edit .select2-group select[name="counterparty_ids"]';
    }

    private function uniqueJsItems($data)
    {
        foreach ($data as &$item) {
            $item = array_unique($item);
        }
        return $data;
    }


    protected function setFilterableCounterpartyList($value): array
    {
        return $value
            ? Counterparty::query()
                ->where('name', 'like', "%$value%")
                ->pluck('name', 'id')
                ->toArray()
            : [];
    }
}
