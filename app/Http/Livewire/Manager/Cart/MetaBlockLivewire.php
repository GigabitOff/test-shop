<?php

namespace App\Http\Livewire\Manager\Cart;

use App\Models\Contract;
use App\Models\DeliveryType;
use App\Models\PaymentType;
use App\Models\User;
use Livewire\Component;

class MetaBlockLivewire extends Component
{

    public ?User $customer = null;
    public ?int $customerId = null;
    public ?DeliveryType $deliveryType = null;

    public ?int $paymentTypeId = null;
    public ?string $paymentTypeName = null;
    public ?int $counterpartyId = null;
    public ?int $contractId = null;
    public ?string $contractName = null;
    public ?int $recipientId = null;
    public ?string $recipientName = null;
    public ?string $recipientINN = null;
    public ?string $postpaidSum = null;

    public array $deliveryData = [];

    public string $comment = '';
    public string $updatingKey = '';

    protected ?User $manager;

    protected bool $hideValidationErrors = true;
    protected $listeners = [
        'eventSetOrderCustomer',
        'eventSetOrderContract',
        'eventSetOrderRecipient',
        'eventSetOrderPaymentType',
        'eventSetOrderDeliveryType',
        'eventSetOrderDeliveryData',
        'eventClearOrderDelivery',
        'setOrderPaymentType',
    ];

    protected $queryString = [
        'customerId' => ['except' => null],
    ];

    public function boot()
    {
        $this->manager = auth()->user();
    }

    public function mount()
    {
        $this->revalidateUpdatingKey();
        $this->initValues();
    }

    public function render()
    {
        if ($this->hideValidationErrors) {
            $this->clearValidation();
        }

        $addressOwner = $this->contractId
            ? (Contract::find((int)$this->contractId) ?? $this->customer)
            : $this->customer;

        return view('livewire.manager.cart.meta-block-livewire', [
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
        $this->customer = $this->manager;
        $this->reset('paymentTypeId', 'paymentTypeName', 'contractId', 'contractName', 'customerId');
        $this->initValues();

        $this->revalidateUpdatingKey();
    }

    /** Event Handlers */
    public function eventSetOrderPaymentType($id, $name)
    {
        $this->paymentTypeId = $id;
        $this->paymentTypeName = $name;
    }

    public function eventSetOrderRecipient($id, $name)
    {
        $this->recipientName = $name;
        $this->recipientId = $id;
    }

    public function eventSetOrderDeliveryType($id)
    {
        $this->deliveryType = DeliveryType::find($id);
        $this->emit('eventReceiveDeliveryDataSaved');
    }

    public function eventSetOrderDeliveryData($payload)
    {
        $this->deliveryData = $payload;
        $this->deliveryData['delivery_type_id'] = $this->deliveryType->id;
    }

    public function eventSetOrderCustomer($id)
    {
        $this->customer = User::find($id);
        $this->customerId = $this->customer->id ?? null;
        $this->reset('recipientId', 'recipientName', 'recipientINN');
        $this->revalidatePaymentTypeDefault();
        $this->revalidateUpdatingKey();
    }

    public function eventSetOrderContract($id)
    {
        $contract = Contract::find($id);
        $this->contractId = $contract->id ?? null;
        $this->contractName = $contract->registry_no ?? '';

        if ($contract) {
            $this->emit('eventReceiveDeliveryDataSaved');
        }

    }

    public function eventClearOrderDelivery()
    {
        $this->deliveryData = [];
    }

    public function saveOrderDraft()
    {
        $this->createOrder('draft');
    }

    public function createOrder($status = 'new')
    {
        $this->hideValidationErrors = false;

        $this->deliveryValid = collect($this->deliveryData)->filter()->join('');

        $this->validate();

        $this->emitUp('eventCreateOrder', [
            'paymentTypeId' => $this->paymentTypeId,
            'contractId' => $this->contractId,
            'recipientId' => $this->recipientId,
            'recipientName' => $this->recipientName,
            'recipientINN' => $this->recipientINN,
            'deliveryType' => $this->deliveryType,
            'deliveryId' => $this->deliveryData['delivery_id'] ?? null,
            'deliveryData' => $this->deliveryData,
            'comment' => $this->comment,
            'postpaidSum' => $this->postpaidSum,
            'status' => $status,
        ]);
    }

    public function rules(): array
    {
        $rules = [
            'customerId' => 'required|filled',
            'paymentTypeId' => 'required',
            'deliveryValid' => 'required',
        ];

        if ($this->isCustomerLegal()) {
            $rules['contractId'] = 'required';
        }

        if ($this->isCustomerSimple() && $this->isPaymentTypeInvoice()) {
            $rules['recipientName'] = 'required';
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
            'customerId.required' => __('custom::site.choice_value_from_list'),
            'paymentTypeId.required' => __('custom::site.choice_value_from_list'),
            'contractId.required' => __('custom::site.choice_value_from_list'),
            'deliveryValid.required' => __('custom::site.delivery_section_must_be_filled'),
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'recipientName' => __('custom::site.recipient'),
            'recipientINN' => __('custom::site.client_tax_number'),
            'postpaidSum' => __('custom::site.postpaid'),
        ];
    }


    /** protected Functions */
    protected function initValues()
    {
        if ($this->customerId && $customer = User::find($this->customerId)) {
            $this->customer = $customer;
        }

        $this->revalidatePaymentTypeDefault();

        $this->deliveryType = DeliveryType::where('id_1c', DeliveryType::DEFAULT)->first();

        $this->deliveryData = [];

        $this->emit('eventReceiveDeliveryDataSaved');
    }

    protected function revalidateUpdatingKey()
    {
        $this->updatingKey = time();
    }

    protected function revalidatePaymentTypeDefault()
    {
        $this->reset('paymentTypeId', 'paymentTypeName');

        if ($this->customer) {
            if ($this->customer->paymentType) {
                $this->paymentTypeId = $this->customer->paymentType->id;
                $this->paymentTypeName = $this->customer->paymentType->name;
            } else {
                $this->paymentTypeId = $this->customer->defaultPaymentType;
                $pt = PaymentType::find($this->paymentTypeId);
                $this->paymentTypeName = $pt->name ?? '';
            }
        }
    }

    protected function isBottomOpen(): bool
    {
        return $this->isCustomerExist();
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

    public function isCustomerExist(): bool
    {
        return (bool)$this->customer;
    }

    public function isCustomerLegal(): bool
    {
        return $this->isCustomerExist() && $this->customer->isCustomerLegal;
    }

    public function isCustomerSimple(): bool
    {
        return $this->isCustomerExist() && $this->customer->isCustomerSimple;
    }

    public function isCanShowDeliverySection(): bool
    {
        return $this->isCustomerExist()
            && (
                $this->customer->isCustomerSimple
                || ($this->customer->isCustomerLegal && $this->contractId)
            );
    }

    public function isCanShowInnField(): bool
    {
        //  Для клиента Физлицо и тип оплаты "Счет" выводим поле ввода ИНН.
        return $this->isCustomerExist()
            && $this->customer->isCustomerSimple
            && $this->isPaymentTypeInvoice();
    }

}
