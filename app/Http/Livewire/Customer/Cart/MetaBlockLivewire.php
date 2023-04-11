<?php
namespace App\Http\Livewire\Customer\Cart;
use App\Models\Contract;
use App\Models\DeliveryType;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class MetaBlockLivewire extends Component
{
    public ?User $customer = null;
    public ?DeliveryType $deliveryType = null;

    public ?int $paymentTypeId = null;
    public ?string $paymentTypeName = null;
    public ?int $counterpartyId = null;
    public ?int $contractId = null;
    public ?string $contractName = null;
    public ?int $recipientId = null;
    public ?string $recipientNa = null;
    public ?string $recipientName = null;
    public ?string $recipientPhone = null;
    public ?string $phone = null;
    public ?string $recipientINN = null;
    public ?string $postpaidSum = null;
    public ?string $recipientFIO = null;
    public array $deliveryData = [];
    public string $comment = '';
    public string $updatingKey = '';
    public int $updateT = 0;
    public $showModal = false;
    public int $deliveryVars = 0;
    public ?int $deliveryTypeIdDu = 0;
    public ?int $recipientIdTu = 0;


    protected bool $hideValidationErrors = true;
    protected $listeners = [
        'eventSetOrderPaymentType',
        'eventSetOrderContract',
        'eventSetOrderCounterparty',
        'eventSetOrderDeliveryType',
        'eventSetOrderDeliveryData',
        'eventSetOrderRecipient',
        'eventSetOrderRecipientPhone',
        'eventClearOrderDelivery',
        'eventOrderCreateSuccess',
        'eventPay',
    ];

    /** Event Handlers */
    public function eventPay($type)
    {
        $this->updateT  = $type;
    }

    public function mount(Request $request)
    {
        $this->customer = auth()->user();

        $this->initValues();

    }

    public int $updateCount = 0;

    public function refreshComponent($paytype)
    {
        $this->updateCount = $paytype;
    }

    public function render()
    {

        if ($this->hideValidationErrors) {
            $this->clearValidation();
        }
        $addressOwner = $this->contractId
            ? (Contract::find((int)$this->contractId) ?? $this->customer)
            : $this->customer;

        return view('livewire.customer.cart.meta-block-livewire', [
            'addressOwner' => $addressOwner,
        ]);
    }

    public function updatedPostpaidSum($value)
    {
        $this->hideValidationErrors = false;
        $this->validateOnly('postpaidSum', ['postpaidSum' => $this->rules()['postpaidSum']]);
    }

    public function resetMetaToDefault()
    {
        $this->reset('paymentTypeId', 'paymentTypeName', 'counterpartyId', 'contractId', 'contractName');
        $this->reset('recipientId', 'recipientName', 'recipientPhone',  'recipientINN', 'postpaidSum');
        $this->reset('deliveryData');
        $this->initValues();
    }

    /** Event Handlers */
    public function eventSetOrderPaymentType($id, $name)
    {

       // $this->eventSetOrderDeliveryType($id, $name);
        $this->paymentTypeId = $id;
        $this->paymentTypeName = $name;
    }

    public function eventSetOrderContract($id, $name)
    {
        $this->contractId = $id;
        $this->contractName = $name;
        $this->emit('eventReceiveDeliveryDataSaved');
    }

    public function eventSetOrderCounterparty($id, $name)
    {
        $this->reset('contractId', 'contractName');
    }

    public function eventSetOrderDeliveryType($id, $name)
    {

       $this->deliveryType = DeliveryType::find($id);
       $this->deliveryData = [];
       $this->emit('eventReceiveDeliveryDataSaved');
       $this->deliveryTypeIdDu = $id;

   }

    public function eventSetOrderRecipient($id, $name)
    {

        $this->recipientName = $name;
        $this->recipientId = $id;
        $this->recipientIdTu = $id;


    }
    public function eventSetOrderRecipientPhone($id, $name)
    {
        $this->recipientPhone =  $name;
        $this->recipientId = $id;

    }

    public function eventSetOrderDeliveryData($payload)
    {
        $this->deliveryData = $payload;
        $this->deliveryData['delivery_type_id'] = $this->deliveryType->id;
    }

    public function eventClearOrderDelivery()
    {
        $this->deliveryData = [];
    }

    public function eventOrderCreateSuccess()
    {
        $this->resetMetaToDefault();
    }

    public function createOrder()
    {

        $this->hideValidationErrors = true;
        $this->deliveryValid = collect($this->deliveryData)->filter()->join('');
        //$this->validate();
        $this->emitUp('eventCreateOrder', [
            'paymentTypeId' => $this->paymentTypeId,
            //'contractId' => $this->contractId,
            'recipientId' => !empty($this->recipientIdTu) ? $this->recipientIdTu : $this->recipientId,
            'recipientName' => $this->recipientName,
            'recipientINN' => $this->recipientINN,
            'recipientFIO' => $this->recipientFIO,
            'deliveryType' => $this->deliveryType,
            'deliveryData' => $this->deliveryData,
            'comment' => $this->comment,
            'postpaidSum' => $this->postpaidSum,
            'phone' => !empty($this->recipientPhone) ? $this->recipientPhone : '',
        ]);

            $this->cleanDelivery();
            $this->cleanComment();

    }

    public function cleanDelivery()
    {
        $this->deliveryVars = 0;
        $this->recipientFIO = null;
    }

    public function cleanComment()
    {
        $this->comment = '';
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function rules(): array
    {
        $rules = [
            'paymentTypeId' => 'required',
            'deliveryValid' => 'required',
        ];

//        if ($this->customer->isCustomerLegal) {
//            $rules['contractId'] = 'required';
//        }

        if ($this->customer->isCustomerSimple && $this->isPaymentTypeInvoice()) {
            $rules['recipientNa'] = 'required';
            $rules['recipientINN'] = 'required';
        }

        if ($this->isPaymentTypePostpaid()) {
            $rules['postpaidSum'] = 'required|numeric';
            if ($receivable = $this->customer->receivable) {
                $max = $receivable->credit_limit - $receivable->sum_debt_total;
                $rules['postpaidSum'] = 'required|numeric|max:' . $max;
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'paymentTypeId.required' => __('custom::site.choice_value_from_list'),
            'contractId.required' => __('custom::site.choice_value_from_list'),
            'deliveryValid.required' => __('custom::site.delivery_section_must_be_filled'),
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'recipientNa' => __('custom::site.recipient'),
            'recipientINN' => __('custom::site.client_tax_number'),
            'postpaidSum' => __('custom::site.postpaid'),
        ];
    }


    /** Private Functions */
    private function initValues()
    {
        $this->updatingKey = time();

        if ($this->customer->paymentType) {
            $this->paymentTypeId = $this->customer->paymentType->id;
            $this->paymentTypeName = $this->customer->paymentType->name;
        } else {
            $this->paymentTypeId = 0;
            $pt = PaymentType::find($this->paymentTypeId);
            $this->paymentTypeName = $pt->name ?? '';

        }

        $this->deliveryType = DeliveryType::where('id_1c', DeliveryType::DEFAULT)->first();
        $this->counterpartyId = $this->customer->counterparty_id;

        $this->emit('eventReceiveDeliveryDataSaved');
    }

    private function isBottomOpen(): bool
    {
        return $this->paymentTypeId
            || $this->contractId;
    }

    protected function isHideRecipientSection(): bool
    {
        return empty($this->paymentTypeId);
    }

    protected function isHideDeliverySection(): bool
    {
        return $this->customer->isCustomerLegal
            ? empty($this->contractId)
            : (empty($this->paymentTypeId) ||
                ($this->paymentTypeId === PaymentType::INVOICE &&
                    (empty($this->recipientINN) ||  empty($this->recipientNa))
                )
            );
    }

    protected function isHideCommentSection(): bool
    {
        return $this->isHideDeliverySection() || empty($this->deliveryData);
    }

    public function isServiceExist(): bool
    {
        return (bool)$this->deliveryType;
    }

    public function isServiceSelfPickup(): bool
    {
        return $this->deliveryType
            && $this->deliveryType->id_1c === DeliveryType::SELF_PICKUP;
    }

    public function isServiceAddressDelivery(): bool
    {
        return $this->deliveryType
            && $this->deliveryType->id_1c === DeliveryType::ADDRESS_DELIVERY;
    }

    public function isServiceNovaPoshta(): bool
    {
        return $this->deliveryType
            && $this->deliveryType->id_1c === DeliveryType::NOVA_POSHTA_SERVICE;
    }

    public function isServiceSat(): bool
    {
        return $this->deliveryType
            && $this->deliveryType->id_1c === DeliveryType::SAT_SERVICE;
    }

    public function isServiceDeliveryAuto(): bool
    {
        return $this->deliveryType
            && $this->deliveryType->id_1c === DeliveryType::DELIVERY_AUTO_SERVICE;
    }

    public function isPaymentTypePostpaid(): bool
    {
        return $this->paymentTypeId === PaymentType::POSTPAID;
    }

    public function isPaymentTypeInvoice(): bool
    {
        return $this->paymentTypeId === PaymentType::INVOICE;
    }
}
