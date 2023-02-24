<?php

namespace App\Http\Livewire\Forms\Manager;

use App\Models\City;
use App\Models\Counterparty;
use App\Models\CounterpartyType;
use App\Models\User;
use App\Rules\EdrpouInnRule;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerCreateLivewire extends Component
{
    public $admin;
    public $manager_id;

    public $legal_entity = false;
    public $company_types = [];
    public $company_type_id;
    public $company_type_self;

    public $fio;
    public $city;
    public $city_id;
    public $cities = [];
    public $position;
    public $phone;
    public $phone_raw;
    public $email;
    public $company_name;
    public $with_vat;

    public $okpo_raw;
    public $okpo;

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

    public function updatedOkpoRaw($value)
    {
        $this->okpo = preg_replace('/[^\d]/', '', $value);
    }

    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            if ($this->legal_entity) {
                $counterparty = new Counterparty();
                $counterparty->name = $this->company_name;
                $counterparty->okpo = $this->okpo;
                $counterparty->is_nds = (bool)$this->with_vat;
                $counterparty->type_id = $this->getCompanyTypeId();
                $counterparty->custom_type = $this->company_type_self;
                $counterparty->city_id = $this->city_id;
                $counterparty->save();
            }

            $customer = new User();

            $customer->name = $this->fio;
            $customer->phone = $this->phone;
            $customer->email = $this->email;
            $customer->city_id = $this->city_id;
            $customer->password = bcrypt(time());
            $customer->manager_id = $this->manager_id ?? null;

            $customer->save();
            $customer->syncRoles(['simple']);

            if (!empty($counterparty)) {
                $customer->counterparties()->syncWithoutDetaching($counterparty->id);
                $customer->position = $this->position;
                $customer->is_admin = true;

                $customer->save();
                $customer->syncRoles(['legal']);
            }


            DB::commit();

            session()->flash('success', __('custom::site.user_add_success'));
            $this->emit('eventCustomerCreated');
            $this->restoreForm();
        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());
            session()->flash('registration_fail', __('custom::site.registration_fail'));
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
        return view('livewire.forms.manager.customer-create-livewire');
    }

    public function rules()
    {
        $rules = [
            'fio' => 'required',
            'phone' => 'required|min:12|unique:users,phone',
            'city_id' => 'required',
        ];
        if ($this->email){
            $rules['email'] = 'required|email|unique:users,email';
        }
        if ($this->legal_entity) {
            $rules['okpo'] = ['required', 'min:8', 'max:10', new EdrpouInnRule()];
            $rules['company_name'] = 'required_if:legal_entity,true';
            $rules['company_type_id'] = 'required_if:legal_entity,true';
            $rules['company_type_self'] = 'required_if:company_type_id,custom';
            if ('custom' !== $this->company_type_id) {
                $rules['company_type_id'] = 'required|exists:counterparty_types,id';
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'phone.unique' => __('custom::site.user_phone_unique'),
            'email.unique' => __('custom::site.user_email_unique'),
        ];
    }

    public function validationAttributes()
    {
        return [
            'company_type_self' => __('custom::site.company_type'),
            'custom' => __('custom::site.self_value'),
        ];
    }

    public function uploadLazyContent($payload = null)
    {
        if ($payload && $this->payload_hash === base64_encode(json_encode($payload))) {
            return;
        }
        $this->payload_hash = base64_encode(json_encode($payload));

        $this->restoreForm();
        if (isset($payload['manager_id'])) {
            $this->manager_id = $payload['manager_id'];
        }

        $this->isUploadLazyContent = true;
    }

    public function restoreForm()
    {

        $this->reset([
            'cities',
            'city_id',
            'city',
            'position',
            'phone_raw',
            'phone',
            'fio',
            'email',
            'with_vat',
            'okpo_raw',
            'okpo',
            'legal_entity',
            'company_name',
            'company_type_id',
            'company_type_self',
        ]);

        $this->clearValidation();
        $this->updateCities();
        $this->updateCompanyTypes();

    }

    private function updateCities()
    {
        $this->cities = City::regionCapitals()->get()->keyBy('id');
    }

    private function updateCompanyTypes()
    {
        $this->company_types = CounterpartyType::query()->withTranslation()
            ->get()->keyBy('id')->map->name
            ->put('custom', __('custom::site.self_value'))
            ->toArray();

        $this->revalidateJsCompanyTypeSelect();
    }

    private function revalidateJsCompanyTypeSelect()
    {
        $this->revalidateJsItems['nice_select'][] =
            '#modal-customer-create select[name="company_type"]';
    }

    private function uniqueJsItems($data)
    {
        foreach ($data as &$item) {
            $item = array_unique($item);
        }
        return $data;
    }

    private function getCompanyTypeId()
    {
        return 'custom' !== $this->company_type_id
            ? (int)$this->company_type_id
            : null;
    }
}
