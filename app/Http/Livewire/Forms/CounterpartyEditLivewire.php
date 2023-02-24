<?php

namespace App\Http\Livewire\Forms;

use App\Http\Livewire\Traits\WithFilterableDrop;
use App\Models\City;
use App\Models\Counterparty;
use App\Models\CounterpartyType;
use App\Models\User;
use App\Rules\EdrpouInnRule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CounterpartyEditLivewire extends Component
{
    use WithFilterableDrop;
    use WithFileUploads;

    /** @var Counterparty $counterparty */
    public $counterparty;

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
    public $data;
    public $data_collect;
    public $select_data;
    public $dataItem;
    public $users_data_user;
    public $users_id;

    public bool $mode_selecting_city = false;
    public bool $isUploadLazyContent = false;

    protected array $revalidateJsItems = [];
    public string $filterableCompanyType = '';
    public string $customCompanyType = '';
    public $file;

    protected $listeners = [
        'setCounterpartyId'
    ];

    public function setCounterpartyId($id)
    {
        $this->counterparty = Counterparty::find($id);
        $this->restoreForm();
        $this->initData();
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

    public function updatedOkpoRaw($value)
    {
        $this->okpo = preg_replace('/[^\d]/', '', $value);
    }

    public function submit()
    {
        if (!$this->counterparty){
            session()->flash('fail_upload', __('custom::site.counterparty_upload_fail'));
            return;
        }

       // logger()->info($this->getCompanyTypeId());
       // exit();

        $validated = $this->validate();

        try {
            $this->counterparty->refresh();

            $path_ustav = $this->file
                ? $this->file->store('counterparties', 'public')
                : '';

            $this->counterparty->name = $validated['company_name'];
            $this->counterparty->okpo = $validated['okpo'];
            $this->counterparty->is_nds = (bool)$this->with_vat;
            $this->counterparty->type_id = $this->getCompanyTypeId();
            $this->counterparty->custom_type = $this->getCustomCompanyType();
            $this->counterparty->ustav_file = $path_ustav;

            $this->counterparty->save();

            if ($user_ids = User::whereIn('id', $this->users_data_user)->pluck('id')) {
                $this->counterparty->users()->sync($user_ids);
            }

            session()->flash('success', __('custom::site.counterparty_edit_success'));
            $this->emit('eventCounterpartyChanged');
        } catch (\Exception $e) {
            session()->flash('fail', __('custom::site.counterparty_edit_fail'));
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

        return view('livewire.forms.counterparty-edit-livewire');
    }

    public function rules(): array
    {
        $rules = [
            'company_name' => 'required',
            'okpo' => ['required', 'min:8', 'max:10',
                new EdrpouInnRule(),
                'unique:counterparties,okpo,' . ($this->counterparty->id ?? 0)
            ],
            'filterableCompanyTypeId' => 'required'
        ];

        if ('custom' !== $this->company_type_id) {
            $rules['company_type_id'] = 'required|exists:counterparty_types,id';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'filterableCompanyTypeId.required' => __('custom::site.choice_value_from_list')
        ];
    }

    /**
     * Обработчик ленивой загрузки.
     * Загружает модель клиента и его контрагента.
     * В случае ошибки получения модели контрагента, отображаем сообщение об ошибке.
     *
     * @param array $payload
     * @return void
     */
    public function uploadLazyContent($payload = null)
    {
        if (isset($payload['counterparty_id'])) {
            $this->counterparty = Counterparty::find((int)$payload['counterparty_id']);
        }

        if (!$this->counterparty) {
            session()->flash('fail_upload', __('custom::site.counterparty_upload_fail'));
        }

        $this->isUploadLazyContent = true;
        $this->restoreForm();
        $this->lazyInit();
        $this->revalidateJsCompanyTypeSelect();
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

    private function getCompanyTypeId(): ?int
    {
        return $this->isNotCustomCompanyType()
            ? ((int)$this->filterableCompanyTypeId ?: null)
            : null;
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


    protected function getFilterableCompanyType($id)
    {
        $res = CounterpartyType::query()
            ->withTranslation()
            ->where('id',$id)
            ->first();
        if($res){
            return $res->name;
        }
        return false;
    }

    public function initData()
    {

        if ($this->counterparty) {

            $users_data_user = $this->counterparty->users()->get();
            foreach ($users_data_user as $key_cu => $value_cu) {
                # code...
                //dd($value_cu);
                $this->users_data_user[$value_cu->id] = $value_cu->id;
                $this->users_id[] = $value_cu->id;
                $this->data['users_name'][$value_cu->id] = $value_cu;

            }

            $this->filterableCompanyTypeId = $this->counterparty->type_id ?? 'custom';
            $this->filterableCompanyType = $this->getFilterableCompanyType($this->counterparty->type_id) ?? '';
           // $this->customCompanyType = $this->counterparty->custom_type ?? null;

            $this->fill([
                'company_name' => $this->counterparty->name,
                'okpo' => $this->counterparty->okpo,
                'okpoRaw' => formatEdrpouNumber($this->counterparty->okpo)
            ]);
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
               // if(in_array($res_user->id,$this->users_id)) {
                    $this->data['users_name'][$res_user->id] = $res_user->toArray();
                    $this->users_data_user[$res_user->id] = $res_user->id;
               // }
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

    public function restoreForm()
    {
        $this->reset(['customCompanyType', 'company_name', 'data', 'okpoRaw', 'okpo', 'with_vat',
            'users_data_user', 'file']);

        $this->clearValidation();
    }

    private function revalidateJsCompanyTypeSelect()
    {
        $this->revalidateJsItems['nice_select'][] =
            '#form-counterparty-edit .nice-select-group select[name="company_type"]';
    }

    private function uniqueJsItems($data)
    {
        foreach ($data as &$item) {
            $item = array_unique($item);
        }
        return $data;
    }

}
