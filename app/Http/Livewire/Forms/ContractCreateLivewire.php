<?php

namespace App\Http\Livewire\Forms;

use App\Models\City;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ContractCreateLivewire extends Component
{
    public $name;
    public $address;
    public $phone;
    public $phone_raw;

    protected $rules = [
        'name' => 'required',
        'phone' => 'required|min:12',
        'address' => 'required',
    ];

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/[^\d]/', '', $value);
    }

    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $customer = $this->customer;

            $customer->name = $this->fio;
            $customer->phone = $this->phone;
            $customer->email = $this->email;
            $customer->city_id = $this->city_id;
            $customer->save();

            if (!in_array($this->counterparty_id, $this->customer->counterparties->pluck('id')->toArray())) {
                $customer->counterparties()
                    ->sync([$this->counterparty_id => ['is_admin' => false, 'position' => $this->position]]);
            }

            $old_contract_ids = $this->customer->contracts->pluck('id')->toArray();
            $unchecked = array_diff($old_contract_ids, $this->contract_ids);
            if ($unchecked){
                //todo: отправить сообщение что пользователь удален из этих контрактов
                // возможно потребуется пререключение привязки заказов.
            }

            $synced = [];
            foreach ($this->contract_ids as $contract_id) {
                $synced[$contract_id] = ['is_admin' => (bool)$this->admin_group];
            }
            $customer->contracts()->sync($synced);

            $customer->syncRoles(['customer', $this->admin_group ? 'customerLegalAdmin' : 'customerLegalUser']);

            DB::commit();

            session()->flash('success', __('custom::site.user_edit_success'));
            $this->emit('eventCustomerChanged');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('fail', __('custom::site.user_edit_fail'));
        }
    }

    public function render()
    {
        return view('livewire.forms.contract-create-livewire');
    }

    public function resetForm()
    {
        $this->reset(['name', 'phone', 'phone_raw', 'address']);
        $this->clearValidation();
    }

}
