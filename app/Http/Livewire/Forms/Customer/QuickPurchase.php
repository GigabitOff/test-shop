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

    public $name;
    public $comment;
    public $phone = '';
    public $phone_raw;

    public $status = self::STATUS_SHOW_PROMPT;

    protected $do_complete_registration = false;

    protected $rules = [
        'name'  => ['required'],
        'phone' => ['required', 'digits:12'],
    ];

    protected $listeners = [
        'fastOrderFormClosed' => 'resetForm',
    ];

    public function boot()
    {
        $this->status = session('quick_purchase_status', self::STATUS_SHOW_PROMPT);
    }

    public function mount()
    {
        if (auth()->check() && !auth()->user()->isRegistrationCompleted()) {
            $this->do_complete_registration = true;
        }
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/[^\d]/', '', $value);
    }

    public function render()
    {
        switch ($this->status) {
            case self::STATUS_SHOW_PROMPT:
                if ($this->do_complete_registration) {
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

        try {
            DB::beginTransaction();
            $customer = User::where('phone', $this->phone)->first()
                ?? app()->make(UsersService::class)
                    ->createUnregisteredCustomer([
                        'name'  => $this->name,
                        'phone' => $this->phone,
                    ]);

            $product_id = session('current_product_id', 0);
            $product_price = session('current_product_price', 0);
            $product_quantity = session('current_product_quantity', 1);

            orders()->createFastOrder($customer, [
                'product_id'       => $product_id,
                'product_price'    => $product_price,
                'product_quantity' => $product_quantity,
                'comment'          => $this->comment,
            ]);

            DB::commit();

            $this->status = self::STATUS_SUCCESS_MSG;
            $this->emit('eventFastOrderCreated');

        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());
            session()->flash('fail', __('custom::site.order_save_fail'));
        }
    }

    public function noNeedRegistration()
    {
        $this->status = self::STATUS_PURCHASE_FORM;
        session(['quick_purchase_status' => $this->status]);
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'comment',
            'phone',
            'phone_raw',
        ]);
        $this->status = self::STATUS_PURCHASE_FORM;
    }
}
