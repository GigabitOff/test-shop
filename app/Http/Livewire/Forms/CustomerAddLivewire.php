<?php

namespace App\Http\Livewire\Forms;

use App\Http\Livewire\Traits\WithFilterableDrop;
use App\Models\City;
use App\Models\Counterparty;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerAddLivewire extends Component
{
    use WithFilterableDrop;

    public string $filterableCity = '';
    public ?User $leader;

    public $fio;
    public $city;
    public $city_id;
    public $cities = [];
    public $position;
    public string $phoneRaw = '';
    public string $phone = '';
    public $email;
    public bool $checkbox_admin = false;

    public $counterparties;
    public $counterparties_data_user;
    public $counterparties_select;
    public $counterparty_ids;
    public $show_counterparty;
    public $data;
    public $data_collect;
    public $select_data;
    public $dataItem;

    public ?string $payload_hash = null;

    public bool $mode_selecting_city = false;
    public bool $isUploadLazyContent = false;

    protected array $revalidateJsItems = [];

    public function mount()
    {
        $this->leader = auth()->user();

        $data = User::withTrashed()->find(auth()->user()->id);

        $this->dataItem = $data;
        $this->data_collect = $data;

        $this->counterparties = Counterparty::limit(10)->get();
        $this->counterparties_select = $this->searchSelectDatatoArray($this->counterparties);

        $this->data = $data->toArray();

        $counterparties_data_user = $this->data_collect->counterparties;

        foreach ($counterparties_data_user as $key_cu => $value_cu) {
            # code...
            //dd($value_cu);
            $this->counterparties_data_user[$value_cu->okpo] = $value_cu->id;
            $this->counterparty_ids[] = $value_cu->id;
            $this->data['counterpaties_name'][$value_cu->okpo] = $value_cu;

        }

        if ($data->counterparty) {
            $this->select_data['counterparty_id']['input'] = $data->counterparty->name;
            $this->select_data['counterparty_id']['id'] = $data->counterparty->id;
        }

    }

    public function render()
    {
        return view('livewire.forms.customer-add-livewire');
    }

    protected function onSetFilterableCity($id, $name)
    {
        $this->validateOnly('filterableCityId');
    }

    public function startAddCounterpaties()
    {
        $this->counterparties_data_user = [0=>''];
        $this->show_counterparty = true;
    }

    public function searchSelectDatatoArray($data, $key_name = 'name', $key_description = 'description')
    {
        $tmp = [];
        foreach ($data as $key => $value) {
            $tmp[$key]['id'] = $value->id;

            if (isset($value[$key_name]))
                $tmp[$key][$key_name] = $value[$key_name];

            if (isset($value[$key_description]))
                $tmp[$key][$key_description] = $value[$key_description];
        }
        return $tmp;
    }

    public function deleteDataList($value=null,$index='',$key='')
    {

        unset($this->select_data[$key]);
        unset($this->data[$key]);
        // dd($this->select_data);

        if($key == 'city')
            unset($this->data['city_id']);

        if($index != ''){
            unset($this->select_data[$index.$key]);
            $key = $index;
        }

        switch ($key) {
            case 'city':
                $this->data['city_id']=null;
                $select_cities = $this->updatedCity('', true);

                $this->select_cities = $this->searchSelectDatatoArray($select_cities, 'name_uk', 'district_uk');

                break;
            case 'counterparty_id':
                $this->data['counterparty_id']=null;
                $this->reset(['counterparties_data_user', 'show_counterparty']);
                $this->counterparties_data_user = null;
                unset($this->data['counterpaties_name']);
                //dd($this->data['counterparty_id']);
                break;
            case 'filter':
                $this->setFilterData();
                break;

            case 'set_menager_':
                $this->reset(['search']);
                $this->dataManagers = User::query()->where('id', $this->search)->orwhereTranslationLike('name', "%$this->search%")->role('manager')->orderBy('id', 'DESC')->get()->keyBy('id');

                break;


            default:
                # code...
                break;
        }

        // dd($this->select_data[$key]);
       // $this->resetPage();

        //$this->changesStart();

    }

    protected function setFilterableCityList($value): array
    {
        /** @var Collection $cities */
        $cities = $value
            ? City::query()->SearchByName($value)->limit(10)->get()
            : City::query()->RegionCapitals()->get();

        return $cities->keyBy(fn($el) => "#{$el->id}")
            ->map(function ($c) {
                return [
                    'text' => $c->name_uk,
                    'title' => $c->name_uk . " ({$c->district_uk} {$c->region_uk})",
                ];
            })
            ->sortBy('text')
            ->toArray();
    }

    public function updatedCity($value)
    {
        if (trim($value)) {
            $this->cities = City::searchByName($value)
                ->limit(10)->get()
                ->keyBy('id');
        } else {
            $this->cities = City::regionCapitals()->get()->keyBy('id');
        }
        $this->mode_selecting_city = true;
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/\D/', '', $value);
    }

    public function updatedEmail($value)
    {
        $this->email = trim($value);
    }

    public function updatedCounterpartyIds($value)
    {
        $this->lazyInitContacts();
    }

    public function submit()
    {
        $validated = $this->validate();

        //logger()->info('counterparties_data_user');
       //logger()->info($this->counterparties_data_user);
       // logger()->info('counterpaties_name');
        //logger()->info($this->data['counterpaties_name']);
       // logger()->info('no_counterpaties_name');
        //logger()->info($this->data['no_counterpaties_name']);
       /// exit();

        try {
            DB::beginTransaction();

            $customer = new User();

            $password = stringDigit(6);

            $customer->name = $this->fio;
            $customer->phone = $this->phone;
            $customer->email = $this->email;
            $customer->city_id = str_replace('#', '', $validated['filterableCityId']);
            $customer->is_admin = $this->checkbox_admin;
            $customer->password = bcrypt($password);
            $customer->position = $this->position;
            $customer->manager()->associate($this->leader->manager);
            $customer->save();
            $customer->syncRoles(['legal']);

            //if ($this->checkbox_admin) {
            //    $ids = $this->leader->counterparties()->pluck('id');
            //    $customer->counterparties()->sync($ids);
           // } else {
            if ($counterparty_ids = Counterparty::whereIn('id', $this->counterparties_data_user)->pluck('id')) {
                $customer->counterparties()->sync($counterparty_ids);
            }
           // }

            smsSend($customer->phone, sprintf(__('custom::site.new_password_sms'), $password), 'user registration');

            DB::commit();

            session()->flash('success', __('custom::site.user_add_success'));
            $this->emit('eventCustomerAdded');
            $this->restoreForm();
            $this->reset('payload_hash');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error($e);
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

    public function setDataOKPO($okpo_str)
    {
        //logger()->info($okpo_str);
        $okpo_arr = explode(',', $okpo_str);

        foreach ($okpo_arr as $key => $value) {
            $okpo = trim($value);
            $res_okpo = Counterparty::where('okpo','LIKE', "$okpo")->orWhere('name', 'LIKE', "$okpo")->first();
            //$res_okpo = Counterparty::get();
            //logger()->info($res_okpo);
            //dd($res_okpo);
            if ($res_okpo) {
                if(in_array($res_okpo->id,$this->counterparty_ids)) {
                    $this->data['counterpaties_name'][$res_okpo->okpo] = $res_okpo->toArray();
                    $this->counterparties_data_user[$res_okpo->okpo] = $res_okpo->id;
                }
            } else {
                //if ($okpo != "")
                    //$this->data['no_counterpaties_name'][$okpo] = $okpo;
            }
        }

    }

    public function unSetDataOKPO($okpo)
    {
        if(isset($this->data['counterpaties_name'][$okpo]))
            unset($this->counterparties_data_user[$okpo]);

        if (isset($this->data['counterpaties_name'][$okpo]))
            unset($this->data['counterpaties_name'][$okpo]);

       if (isset($this->data['no_counterpaties_name'][$okpo]))
            unset($this->data['no_counterpaties_name'][$okpo]);
    }

    public function rules(): array
    {
        $rules = [
            'fio' => 'required|min:3',
            'phone' => 'required|bail|min:12|unique:users,phone',
            'email' => 'required|unique:users,email',
            'filterableCityId' => 'required'
        ];

        if (!$this->checkbox_admin) {
            $rules['counterparties_data_user'] = 'required';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'phone.unique' => __('custom::site.user_phone_unique'),
            'email.unique' => __('custom::site.user_email_unique'),
            'filterableCityId.required' => __('custom::site.choice_value_from_list')
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'counterparties_data_user' => __('custom::site.counterparty')
        ];
    }

    protected function restoreForm()
    {
        $this->reset(
            [
                'city_id',
                'city',
                'position',
                'phoneRaw',
                'phone',
                'fio',
                'email',
                'counterparties',
                'counterparties_data_user',
                'data'
            ]
        );

        $this->resetFilterable('filterableCity');
        $this->clearValidation();

    }

}
