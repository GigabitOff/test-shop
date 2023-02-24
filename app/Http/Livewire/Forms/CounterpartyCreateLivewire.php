<?php

namespace App\Http\Livewire\Forms;

use App\Http\Livewire\Traits\WithFilterableDrop;
use App\Models\City;
use App\Models\Counterparty;
use App\Models\CounterpartyType;
use App\Models\User;
use App\Rules\EdrpouInnRule;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CounterpartyCreateLivewire extends Component
{
    use WithFilterableDrop;
    use WithFileUploads;

    public ?User $customer;

    public $city;
    public $city_id;
    public $cities = [];
    public $with_vat;
    public $company_name;
    public $company_types = [];
    public $company_type_id;
    public $company_type_self;
    public $position;
    public $okpo_raw;
    public string $okpoRaw = '';
    public $okpo;
    public string $filterableCompanyType = '';
    public $data;
    public $data_collect;
    public $select_data;
    public $dataItem;
    public $users_data_user;
    public $users_id;
    public string $customCompanyType = '';
    public $file;

    public function mount()
    {
        $data = User::withTrashed()->find(auth()->user()->id);

        $this->customer = auth()->user();
        $this->dataItem = $data;
        $this->data_collect = $data;

        $this->data = $data->toArray();

        $users_data_user = $this->data_collect->customers()->get();
        foreach ($users_data_user as $key_cu => $value_cu) {
            # code...
            //dd($value_cu);
            //$this->users_data_user[$value_cu->id] = $value_cu->id;
            $this->users_id[] = $value_cu->id;
            //$this->data['users_name'][$value_cu->id] = $value_cu;

        }

    }

    public function render()
    {
        return view('livewire.forms.counterparty-create-livewire');
    }

    protected function setFilterableCompanyTypeList(): array
    {
        return CounterpartyType::query()
            ->withTranslation()
            ->get()
            ->keyBy('id')
            ->map->name
            ->put('custom', __('custom::site.self_value'))
            ->toArray();
    }

    public function updatedOkpoRaw($value)
    {
        $this->okpo = preg_replace('/[^\d]/', '', $value);
    }

    protected function onSetFilterableCompanyType($id, $name)
    {
        $this->validateOnly('filterableCompanyTypeId');
    }

    public function isCustomCompanyType(): bool
    {
        return 'custom' === $this->filterableCompanyTypeId;
    }

    public function isNotCustomCompanyType(): bool
    {
        return !$this->isCustomCompanyType();
    }

    private function getCustomCompanyType(): ?string
    {
        return $this->isCustomCompanyType()
            ? ($this->customCompanyType ?: null)
            : null;
    }

    public function submit()
    {
        if (!$this->customer) {
            session()->flash('fail_upload', __('custom::site.customer_undefined'));
        }

        $validated = $this->validate();

        try {
            $this->customer->refresh();

            $path_ustav = $this->file
                ? $this->file->store('counterparties', 'public')
                : '';

            DB::beginTransaction();

            $counterparty = new Counterparty();
            $counterparty->name = $validated['company_name'];
            $counterparty->okpo = $validated['okpo'];
            $counterparty->is_nds = (bool)$this->with_vat;
            $counterparty->type_id = $this->getCompanyTypeId();
            $counterparty->custom_type = $this->getCustomCompanyType();
            $counterparty->ustav_file = $path_ustav;
            $counterparty->founder()->associate($this->customer);
            $counterparty->save();

            //$counterparty->users()->sync($this->customer->siblingAdmins()->pluck('id'));

            if ($user_ids = User::whereIn('id', $this->users_data_user)->pluck('id')) {
                $counterparty->users()->sync($user_ids);
            }

            DB::commit();

            session()->flash('success', __('custom::site.counterparty_create_success'));
            $this->emit('eventCounterpartyCreated');
            $this->restoreForm();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('fail', __('custom::site.counterparty_create_fail'));
        }
    }

    public function setDataUSER($user_str)
    {
        $user_arr = explode(',', $user_str);

        foreach ($user_arr as $key => $value) {
            $user = trim($value);

            $res_user = User::query()
                ->withTranslation()
                ->where(fn($q) => $q->whereTranslationLike('name', "%{$user}%")
                    ->orWhereDigitFieldLike('phone', "%{$value}%")
                    ->orWhere('position', 'like', "%{$user}%")
                    ->orWhere('email', 'like', "%{$user}%")
                )->first();
            //$res_okpo = Counterparty::get();

            //dd($res_okpo);
            if ($res_user) {
                if(in_array($res_user->id,$this->users_id)) {
                    $this->data['users_name'][$res_user->id] = $res_user->toArray();
                    $this->users_data_user[$res_user->id] = $res_user->id;
                }
            } else {
                //if ($user != "")
                    //$this->data['no_users_name'][$user] = $user;
            }
        }

    }

    public function unSetDataUSER($id)
    {
        if(isset($this->data['users_name'][$id]))
            unset($this->users_data_user[$id]);

        if (isset($this->data['users_name'][$id]))
            unset($this->data['users_name'][$id]);

        if (isset($this->data['no_users_name'][$id]))
            unset($this->data['no_users_name'][$id]);
    }

    public function rules(): array
    {
        $rules = [
            'company_name' => 'required',
            'okpo' => ['required', 'bail', 'min:8', 'max:10', new EdrpouInnRule()]
        ];

        if ($this->isCustomCompanyType()) {
            $rules['customCompanyType'] = 'required';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'filterableCompanyType.required' => __('custom::site.choice_value_from_list')
        ];
    }

    private function getCompanyTypeId(): ?int
    {
        return $this->isNotCustomCompanyType()
            ? ((int)$this->filterableCompanyTypeId ?: null)
            : null;
    }

    public function restoreForm()
    {
        $this->reset(['customCompanyType', 'company_name', 'data', 'okpoRaw', 'okpo', 'with_vat', 'users_data_user', 'file']);

        $this->resetFilterable('filterableCompanyType');

        $this->clearValidation();
    }

}
