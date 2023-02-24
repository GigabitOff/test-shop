<?php

namespace App\Http\Livewire\Manager\Orders;

use App\Models\DeliveryType;
use App\Models\OrderEdited;
use App\Models\PaymentType;
use App\Models\User;
use Livewire\Component;

class EditMetaBlockLivewire extends Component
{
    public OrderEdited $order;
    public User $customer;
    public ?int $paymentTypeId = null;
    public ?string $paymentTypeName = null;
    public ?int $counterpartyId = null;
    public ?int $contractId = null;
    public ?string $contractName = null;
    public ?int $recipientId = null;
    public ?string $recipientName = null;
    public ?string $recipientINN = null;
    public ?float $postpaidSum = null;

    public ?DeliveryType $deliveryType = null;
    public ?int $deliveryAddressId = null;
    public array $deliveryData = [];

    public ?string $comment = null;
    public int $updatingKey;

    protected bool $hideValidationErrors = true;
    protected $listeners = [
        'eventSetOrderPaymentType',
        'eventSetOrderContract',
        'eventSetOrderCounterparty',
        'eventSetOrderRecipient',
        'eventSetOrderDeliveryType',
        'eventSetOrderDeliveryData',
        'eventClearOrderDelivery',
    ];

    public function mount()
    {
        $this->updatingKey = time();
        $this->customer = $this->order->customer;
        $this->deliveryAddressId = $this->order->delivery_address_id;
        $this->initValuesByOrder();
    }

    public function render()
    {
        if ($this->hideValidationErrors) {
            $this->clearValidation();
        }

        $types = $this->customer->availablePaymentTypes()->get();
        $contracts = $this->customer->contracts;
        $addressOwner = $this->order->contract ?? $this->customer;
        return view('livewire.manager.orders.edit-meta-block-livewire', [
            'paymentTypeList' => $types,
            'contracts' => $contracts,
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
        $this->initValuesByOrder();
        $this->updatingKey = time();
    }

    /** Event Handlers */
    public function eventSetOrderPaymentType($id, $name)
    {
        $this->paymentTypeId = $id;
        $this->paymentTypeName = $name;
    }

    public function eventSetOrderContract($id, $name)
    {
        $this->contractId = $id;
        $this->contractName = $name;
        $this->reset('deliveryData');
        $this->emit('eventReceiveDeliveryDataSaved');
    }

    public function eventSetOrderCounterparty($id, $name)
    {
        $this->reset('contractId', 'contractName', 'deliveryData');
    }

    public function eventSetOrderRecipient($id, $name)
    {
        $this->recipientName = $name;
        $this->recipientId = $id;
    }

    public function eventSetOrderDeliveryType($id, $name)
    {
        $this->deliveryType = DeliveryType::find($id);
        $saved = $this->order->deliveryAddress;
        $this->deliveryAddressId = $saved->delivery_type_id === $id
            ? $saved->id
            : null;

        $this->emit('eventReceiveDeliveryDataSaved');
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

    public function createOrder()
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
        ]);
    }

    public function rules(): array
    {
        $rules = [
            'paymentTypeId' => 'required',
            'deliveryValid' => 'required',
        ];

        if ($this->customer->isCustomerLegal) {
            $rules['contractId'] = 'required';
        }

        if ($this->customer->isCustomerSimple && $this->isPaymentTypeInvoice()) {
            $rules['clientName'] = 'required';
            $rules['clientINN'] = 'required';
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
            'clientName' => __('custom::site.recipient'),
            'clientINN' => __('custom::site.client_tax_number'),
            'postpaidSum' => __('custom::site.postpaid'),
        ];
    }


    /** Private Functions */
    private function initValuesByOrder()
    {
        $editOrder = $this->order;

        $recipient = $editOrder->recipient;
        $this->recipientId = $recipient->id ?? null;
        $this->recipientName = $recipient->name ?? null;
        $this->recipientINN = $recipient->inn ?? null;

        $this->paymentTypeId = $editOrder->paymentType->id ?? '';
        $this->paymentTypeName = $editOrder->paymentType->name ?? '';

        $deliveryAddress = $editOrder->deliveryAddress;
        $this->deliveryType = $deliveryAddress->deliveryType;

        $this->deliveryData = [
            'delivery_id' => $deliveryAddress->id,
            'city_id' => $deliveryAddress->city_id ?? null,
            'delivery_type_id' => $deliveryAddress->delivery_type_id ?? null,
            'warehouse_id' => $deliveryAddress->warehouse_id ?? null,
            'address_full' => $deliveryAddress->address_full ?? null,
            'street_type' => $deliveryAddress->street_type ?? null,
            'street_name' => $deliveryAddress->street_name ?? null,
            'dom' => $deliveryAddress->dom ?? null,
            'korpus' => $deliveryAddress->korpus ?? null,
            'office' => $deliveryAddress->office ?? null,
            'city_name' => $deliveryAddress->city_name ?? null,
            'city_guid' => $deliveryAddress->city_guid ?? null,
            'otdel_number' => $deliveryAddress->otdel_number ?? null,
            'otdel_guid' => $deliveryAddress->otdel_guid ?? null,
            'otdel_name' => $deliveryAddress->otdel_name ?? null,
            'additional_data' => $deliveryAddress->additional_data ?? null,
            'departure_at' => $deliveryAddress->departure_at ?? null,
        ];

        $contract = $editOrder->contract;
        $this->contractId = $contract->id ?? null;
        $this->contractName = $contract->registry_no ?? null;
        $this->counterpartyId = $contract->counterparty_id ?? null;

        $this->comment = $editOrder->comment;
        $this->postpaidSum = $editOrder->debt_sum;

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
                    (empty($this->recipientINN) || empty($this->recipientName))
                )
            );
    }

    protected function isHideCommentSection(): bool
    {
        return $this->isHideDeliverySection() || empty($this->deliveryData);
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

    public function isCanShowDeliverySection(): bool
    {
        return $this->paymentTypeId === PaymentType::INVOICE;
    }
}
