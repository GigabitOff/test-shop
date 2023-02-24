<?php

namespace App\Http\Livewire\Forms\Customer;

use App\Models\City;
use App\Models\CounterpartyType;
use App\Models\PaymentType;
use App\Models\User;
use App\Models\UserChange;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PersonalDataEditLivewire extends Component
{
    public $user;

    public $fio;
    public $email;
    public $city;
    public $city_id;
    public $cities = [];
    public $phone_raw;
    public $phone;
    public $position;
    public $payment_type_id;
    public $payment_types = [];

    public $mode_selecting_city = false;
    public $isUploadLazyContent = false;
    public $data_on_moderation = false;

    protected $changes;

    public function updatedCity($value)
    {
        if (trim($value)) {
            $this->cities = City::query()->SearchByName($value)
                ->limit(10)->get()
                ->keyBy('id');
        } else {
            $this->cities = City::RegionCapitals()->get()->keyBy('id');
        }
        $this->mode_selecting_city = true;
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/[^\d]/', '', $value);
        $this->validateOnly('phone');
    }

    public function submit()
    {
        $this->validate();

        try {

            if ($this->user->isCustomerLegal) {
                $exist = false;
                $changes = UserChange::where('user_id', $this->user->id)->first()
                    ?? new UserChange();

                $changes->user_id = $this->user->id;
                if ($this->user->name != $this->fio) {
                    $changes->name = $this->fio;
                    $exist = true;
                } else {
                    $changes->name = null;
                }
                if ($this->user->email != $this->email) {
                    $changes->email = $this->email;
                    $exist = true;
                } else {
                    $changes->email = null;
                }
                if ($this->user->phone != $this->phone) {
                    $changes->phone = $this->phone;
                    $exist = true;
                } else {
                    $changes->phone = null;
                }

                if ($this->user->city_id != $this->city_id
                    && City::find($this->city_id ?? 0)) {
                    $changes->city_id = $this->city_id;
                    $exist = true;
                } else {
                    $changes->city_id = null;
                }

                if ($this->user->payment_type_id != $this->payment_type_id
                    && PaymentType::find($this->payment_type_id ?? 0)) {
                    $changes->payment_type_id = $this->payment_type_id;
                    $exist = true;
                } else {
                    $changes->payment_type_id = null;
                }

                if ($this->user->position != $this->position) {
                    $changes->position = $this->position;
                    $exist = true;
                } else {
                    $changes->position = null;
                }

                if ($exist) {
                    $changes->user_id = $this->user->id;
                    $changes->save();
                    session()->flash('success', __('custom::site.personal_data_go_to_moderate'));
                } elseif ($changes->user_id) {
                    $changes->delete();
                    session()->flash('success', __('custom::site.data_recovered'));
                }

                $this->changes = $changes ?? new UserChange();

            } else {
                $this->user->name = $this->fio;
                $this->user->email = $this->email;
                if ($this->user->phone != $this->phone) {
                    $this->user->phone = $this->phone;
                    $this->user->phone_verified_at = null;
                }

                if ($city = City::find($this->city_id ?? 0)) {
                    $this->user->city()->associate($city);
                }

                if ($paymentType = PaymentType::find($this->payment_type_id ?? 0)) {
                    $this->user->paymentType()->associate($paymentType);
                }

                $this->user->save();

                $this->changes = new UserChange();
                session()->flash('success', __('custom::site.data_saved'));
            }

            $this->emit('eventPersonalDataChanged');
        } catch (\Exception $e) {
            session()->flash('fail', __('custom::site.personal_data_edit_fail'));
        }

    }

    public function selectCity($id)
    {
        if ($city = City::find($id ?? 0)) {
            $this->city_id = $id;
            $this->city = $city->name_uk;
        }

        $this->mode_selecting_city = false;

        $this->validateOnly('city_id');
    }

    public function render()
    {
        $revalidateJsItems['nice_select'][] =
            '#modal-personal-data-edit select[name="type-payment"]';

        $this->emit('revalidate', $revalidateJsItems);

        return view('livewire.forms.customer.personal-data-edit-livewire', [
            'changes' => $this->changes,
        ]);
    }

    public function rules()
    {
        $rules = [
            'city_id' => 'required',
            'fio' => 'required|min:3',
            'phone' => 'required|min:12|unique:users,phone,' . $this->user->id,
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'city_id.required' => __('custom::site.choice_value_from_list'),
        ];
    }

    public function uploadLazyContent($payload = null)
    {
        $this->isUploadLazyContent = true;
        $this->lazyInit();
    }

    public function lazyInit()
    {
        /** @var User $user */
        $user = auth()->user();
        $changes = UserChange::where('user_id', $user->id)->first();
        $this->data_on_moderation = (bool)$changes;

        $this->company_types = CounterpartyType::query()->withTranslation()
            ->get()->keyBy('id')->map->name
            ->put('custom', __('custom::site.self_value'))
            ->toArray();

        $this->cities = City::regionCapitals()->get()->keyBy('id');

        $this->payment_types = $user->availablePaymentTypes()->get();

        $this->fill([
            'phone_raw' => formatPhoneNumber($user->phone),
            'fio' => $changes->name ?? $user->name,
            'email' => $changes->email ?? $user->email,
            'phone' => $changes->phone ?? $user->phone,
            'position' => $changes->position ?? $user->position,
            'city_id' => $changes->city_id ?? $user->city_id,
            'city' => $changes->city->name_uk ?? $user->city->name_uk,
            'payment_type_id' => $changes->payment_type_id ?? $user->payment_type_id,
        ]);

        $this->user = $user;
        $this->changes = $changes ?? new UserChange();
    }

}
