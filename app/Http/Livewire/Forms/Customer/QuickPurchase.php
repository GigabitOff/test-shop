<?php

namespace App\Http\Livewire\Forms\Customer;

use App\Models\User;
use App\Services\UsersService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class QuickPurchase extends Component
{
    const STATUS_SHOW_PROMPT = 'prompt';
    const STATUS_PURCHASE_FORM = 'purchase';
    const STATUS_SUCCESS_MSG = 'success';

    public $phone_raw;
    public $name;
    public $company;
    public $product_id;

    public $phone = '';
    public $phone2 = ''; // Требуется для вывода ошибок с доп html
    public $invalidMsg = '';
    public $proposeMsg = '';

    public $status = self::STATUS_SHOW_PROMPT;

    protected $do_complete_registration = false;

    protected $listeners = [
        'quick-purchase-modal.restore-form' => 'restoreForm',
    ];

    public function boot()
    {
        $this->status = session('quick_purchase_status', self::STATUS_SHOW_PROMPT);
    }

    public function mount()
    {
        if (auth()->check() && !auth()->user()->isRegistrationCompleted()){
            $this->do_complete_registration = true;
        }
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/[^\d]/', '', $value);
        $this->selfPhoneValidation($value);
    }

    public function render()
    {
        switch ($this->status) {
            case self::STATUS_SHOW_PROMPT:
                if ($this->do_complete_registration){
                    return view('livewire.forms.customer.register-complete-prompt');
                }
                return view('livewire.forms.customer.login-prompt');
            case self::STATUS_PURCHASE_FORM:
                return view('livewire.forms.customer.quick-purchase');
            case self::STATUS_SUCCESS_MSG:
                return view('livewire.forms.customer.quick-purchase-success');
        }
        return '';
    }

    public function submit()
    {
        $this->validate();
        if (! $this->selfPhoneValidation()){
            return;
        }

        try {
            DB::beginTransaction();
            $customer = User::where('phone', $this->phone)->first()
                ?? app()->make(UsersService::class)
                    ->CreateNewUnregisteredCustomer([
                        'fio' => $this->name,
                        'phone' => $this->phone,
                    ]);

            $order = orders()->createOrderFromCart($customer);
            $order->fast_order = true;
            $order->save();

            DB::commit();

            $this->status = self::STATUS_SUCCESS_MSG;
            $this->emit('eventFastOrderCreated');

        } catch (\Exception $e){
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());
            session()->flash('fail', __('custom::site.order_save_fail'));
        }
    }

    protected function selfPhoneValidation(){
        $this->invalidMsg = '';
        $this->proposeMsg = '';
        $this->validateOnly('phone');
        $customer = User::where('phone', $this->phone)->first();
        if($customer && !$customer->isCustomerUnregistered){
            $this->proposeMsg = __('custom::site.user_phone_unique');
        }
        return empty($this->proposeMsg);
    }

    public function rules()
    {
        $rules = [
            'name' => ['required'],
            'phone' => ['required', 'digits:12'],
        ];

        return $rules;
    }


    public function noNeedRegistration()
    {
        $this->status = self::STATUS_PURCHASE_FORM;
        session(['quick_purchase_status' => $this->status]);
    }

    public function restoreForm()
    {
        $this->status = self::STATUS_PURCHASE_FORM;
        $this->product_id = null;
    }
}
