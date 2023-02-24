<div class="lk-page-total">
    <div class="total-action">
        <div class="total-action__top">
            <div class="row">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <livewire:order-meta-blocks.dropdown-payment-type-livewire
                                :customer="$customer"
                                :paymentId="$paymentTypeId"
                                :key="'dropdown-payment-type_' . $updatingKey"/>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div @if($this->isHideRecipientSection()) style="display: none" @endif>

                                @if($customer->isCustomerSimple)
                                    <button
                                        class="js-add-comment button button-primary button-block"
                                        type="button">@lang('custom::site.recipient')</button>
                                @else
                                    {{--                                <livewire:order-meta-blocks.dropdown-contract-livewire--}}
                                    {{--                                    :customerId="$customer->id"--}}
                                    {{--                                    :contractId="$contractId"--}}
                                    {{--                                    :key="'dropdown-contract_' . $updatingKey" />--}}
                                    <livewire:order-meta-blocks.dropdown-counterparty-livewire
                                        :customerId="$customer->id"
                                        :counterpartyId="((int)$counterpartyId)"
                                        :editedOrderId="$order->id"
                                        :key="'dropdown-counterparty_' . $updatingKey"/>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div @if($this->isHideDeliverySection()) style="display: none" @endif>
                                <livewire:order-meta-blocks.dropdown-delivery-type-livewire
                                    :deliveryTypeId="$deliveryType->id"
                                    :key="'dropdown-delivery-type_' . $updatingKey"/>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <button
                                @if($this->isHideCommentSection()) style="display: none;" @endif
                            class="js-add-comment button button-primary button-block"
                                type="button">@lang('custom::site.Comment')</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 text-right">
                    <button class="button button-secondary button-block"
                            @if($this->isHideCommentSection()) style="display: none;" @endif
                            wire:click="createOrder"
                            onclick="$('.lk-page-total').find('.invalid-feedback').hide('slow')"
                            type="button">@lang('custom::site.Confirm')</button>
                </div>
            </div>
        </div>
        <div class="total-action__bottom" style="@if(!$this->isBottomOpen()) display: none; @endif">
            <div class="row">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-xl-3">
                            @if($this->isPaymentTypePostpaid())
                                <div class="form-group">
                                    <input class="form-control"
                                           type="number"
                                           wire:model.lazy="postpaidSum"
                                           placeholder="@lang('custom::site.postpaid_sum')">
                                    @error('postpaidSum')
                                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                                    @enderror
                                </div>
                            @else
                                <div
                                    class="total-action-value total-action-value--pay js-value-pay">{{$paymentTypeName}}</div>
                            @endif
                        </div>
                        <div class="col-xl-3">
                            <div class="total-action-value--customer"
                                 @if($this->isHideRecipientSection()) style="display: none" @endif>
                                @if($customer->isCustomerLegal)
                                    <livewire:order-meta-blocks.contract-selector-livewire
                                        :customer="$customer"
                                        :counterpartyId="((int)$counterpartyId)"
                                        :contractId="((int)$contractId)"
                                        :key="'contract-selector_' . $updatingKey"/>
                                    @error('contractName')
                                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                                    @enderror
                                @endif
                                <div class="form-group custome-dropdown custome-dropdown--arrow --empty">
                                    <livewire:order-meta-blocks.recipient-selector-livewire
                                        :customer="$customer"
                                        :recipientName="$recipientName"/>
                                    @error('recipientName')
                                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                                    @enderror
                                </div>
                                @if($customer->isCustomerSimple && $this->isPaymentTypeInvoice())
                                    {{-- Для клиента Физлицо и тип оплаты "Счет" выводим поле ввода ИНН --}}
                                    <div class="form-group">
                                        <input class="form-control"
                                               type="text"
                                               wire:model.lazy="recipientINN"
                                               placeholder="@lang('custom::site.client_tax_number')">
                                        @error('recipientINN')
                                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                                        @enderror

                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="total-action-value--delivery"
                                 @if($this->isHideDeliverySection()) style="display: none" @endif>
                                @if($this->isServiceSelfPickup())
                                    <div class="delivery-content self-pickup-service">
                                        <div class="form-group">
                                            <livewire:order-meta-blocks.self-pickup-livewire
                                                :deliveryAddressId="$deliveryAddressId"
                                                :key="'self-pickup-service_' . $updatingKey"/>
                                        </div>
                                    </div>
                                @elseif($this->isServiceAddressDelivery())
                                    <div class="delivery-content address-delivery-service">
                                        <div>
                                            <livewire:order-meta-blocks.address-delivery-livewire
                                                :deliveryAddressId="$deliveryAddressId"
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'address-delivery-service_' . $updatingKey"/>
                                        </div>
                                    </div>
                                @elseif($this->isServiceNovaPoshta())
                                    <div class="delivery-content nova-poshta-service">
                                        <div>
                                            <livewire:order-meta-blocks.nova-poshta-livewire
                                                :deliveryAddressId="$deliveryAddressId"
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'nova-poshta-service_' . $updatingKey"/>
                                        </div>
                                    </div>
                                @elseif($this->isServiceSat())
                                    <div class="delivery-content sat-service">
                                        <div>
                                            <livewire:order-meta-blocks.sat-livewire
                                                :deliveryAddressId="$deliveryAddressId"
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'sat-service_' . $updatingKey"/>
                                        </div>
                                    </div>
                                @elseif($this->isServiceDeliveryAuto())
                                    <div class="delivery-content delivery-auto-service">
                                        <div>
                                            <livewire:order-meta-blocks.delivery-auto-livewire
                                                :deliveryAddressId="$deliveryAddressId"
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'delivery-auto-service_' . $updatingKey"/>
                                        </div>
                                    </div>
                                @else
                                    <div class="delivery-content imported-delivery-service">
                                        <div>
                                            <livewire:order-meta-blocks.imported-delivery-livewire
                                                :deliveryAddressId="$deliveryAddressId"
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'imported-delivery-service_' . $updatingKey"/>
                                        </div>
                                    </div>
                                @endif
                                @error('deliveryValid')
                                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <textarea class="total-action-value js-value-comment"
                                      @if($this->isHideCommentSection()) style="display: none" @endif
                                      wire:model.lazy="comment"
                                      placeholder="@lang('custom::site.comment_text')"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2">
                    <button class="js-value-clear button button-outline-accent button-block"
                            wire:click="resetMetaToDefault"
                            type="button">
                        @lang('custom::site.cancel')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.emit('eventReceiveDeliveryDataSaved');
        })
    </script>
@endpush
