<?php

namespace App\Http\Livewire\Forms\Manager;

use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerAddLivewire extends Component
{
    public $fio;
    public $city;
    public $city_id;
    public $cities = [];
    public $position;
    public $phone;
    public $phone_raw;
    public $email;
    public $admin_group;

    public int $counterparty = 0;
    public array $counterparties = [];
    public array $contract_ids = [];
    public array $contracts = [];

    public $payload_hash;

    public $mode_selecting_city = false;
    public $isUploadLazyContent = false;

    protected $revalidateJsItems = [];

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

    public function updatedAdminGroup($checked)
    {
        if ($checked){
            $this->contract_ids = $this->counterparty->contracts->pluck('id')->toArray();
            $this->revalidateJsContractsSelect();
        }
    }

    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $customer = new User();

            $customer->name = $this->fio;
            $customer->phone = $this->phone;
            $customer->email = $this->email;
            $customer->city_id = $this->city_id;
            $customer->password = bcrypt(time());
            $customer->position = $this->position;
            $customer->manager_id = auth()->user()->id;
            $customer->counterparties()->sync($this->counterparty->id);
            $customer->is_admin = (bool)$this->admin_group;
            $customer->save();

            $customer->contracts()->sync($this->contract_ids);

            $customer->syncRoles(['legal']);

            DB::commit();

            session()->flash('success', __('custom::site.user_add_success'));
            $this->emit('eventCustomerAdded');
            $this->restoreForm();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('fail', __('custom::site.user_add_fail'));
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

        return view('livewire.forms.manager.customer-add-livewire');
    }

    public function rules(): array
    {
        return [
            'fio' => 'required',
            'phone' => 'required|min:12|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'city_id' => 'required',
            'contract_ids' => 'required|array|min:1',
        ];
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
            'contract_ids' => __('custom::site.contract'),
        ];
    }

    public function uploadLazyContent($payload = null)
    {
        if ($payload && $this->payload_hash === base64_encode(json_encode($payload))) {
            return;
        }
        $this->payload_hash = base64_encode(json_encode($payload));

        $this->restoreForm();
        $this->isUploadLazyContent = false;

        if (isset($payload['founder_id'])) {
            if ($founder = User::find((int)$payload['founder_id'])) {
                $this->counterparties = $founder->counterparties()->onlyModerated()
                    ->pluck('name', 'id')->toArray();
            }
        }

        if (!$this->counterparties) {
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.user_add'),
                'message' => __('custom::site.form_load_error'),
                'state' => 'danger',
            ]);
            return;
        }

        $this->isUploadLazyContent = true;
        $this->cities = City::regionCapitals()->get()->keyBy('id');
    }

    public function restoreForm()
    {

        $this->reset([
            'city_id',
            'city',
            'position',
            'phone_raw',
            'phone',
            'fio',
            'email',
            'contracts',
            'contract_ids',
            'mode_selecting_city',
        ]);

        $this->clearValidation();
    }

    private function revalidateJsContractsSelect()
    {
        $this->revalidateJsItems['select2'][] =
            '#modal-customer-add select[name="contracts"]';
    }

    private function uniqueJsItems($data)
    {
        foreach ($data as &$item) {
            $item = array_unique($item);
        }
        return $data;
    }
}
