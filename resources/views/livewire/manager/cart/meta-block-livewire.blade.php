<div class="lk-page-total">
    <div class="total-action">
        <div class="total-action__top">
            <div class="row">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <livewire:order-meta-blocks.dropdown-customer-livewire/>
                            @error('customerId')
                            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            @if($this->isCustomerExist())
                                <livewire:order-meta-blocks.dropdown-payment-type-livewire
                                    :customer="$customer"
                                    :paymentId="$paymentTypeId"
                                    :key="'dropdown-payment-type_' . $updatingKey"/>
                            @endif
                        </div>
                        @if($this->isCanShowDeliverySection())
                            <div class="col-xl-3 col-md-6 mb-4">
                                <livewire:order-meta-blocks.dropdown-delivery-type-livewire
                                    :deliveryTypeId="$deliveryType->id ?? 0"
                                    :key="'dropdown-delivery-type_' . $updatingKey"/>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <button
                                    class="js-add-comment button button-primary button-block"
                                    type="button">@lang('custom::site.Comment')</button>
                            </div>
                        @endif
                    </div>
                </div>
                @if($this->isCanShowDeliverySection())
                    <div class="col-xl-2 text-right">
                        <button class="button button-secondary button-block"
                                wire:click="createOrder"
                                onclick="$('.lk-page-total').find('.invalid-feedback').hide('slow')"
                                type="button">@lang('custom::site.Confirm')</button>
                    </div>
                @endif
            </div>
        </div>
        <div class="total-action__bottom" style="@if(!$this->isBottomOpen()) display: none; @endif">
            <div class="row">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-xl-3">
                            @if($this->isCustomerLegal())
                                <div class="form-group">
                                    <livewire:order-meta-blocks.counterparty-contract-selector-livewire
                                        :customer="$customer"
                                        :key="'counterparty-contract-selector_' . $updatingKey"/>
                                </div>
                            @endif
                            @if($this->isCustomerExist())
                                <div class="form-group custome-dropdown custome-dropdown--arrow --empty">
                                    <livewire:order-meta-blocks.recipient-selector-livewire
                                        :customer="$customer"
                                        :recipientName="$recipientName"
                                        :key="'recipient-selector_' . $updatingKey"/>
                                    @error('recipientName')
                                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                                    @enderror
                                </div>
                            @endif
                        </div>
                        <div class="col-xl-3">
                            @if($this->isCustomerExist())
                                <div class="total-action-value--customer js-value-customer">
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
                                    @if($this->isCanShowInnField())
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
                            @endif
                        </div>
                        @if($this->isCanShowDeliverySection())
                            <div class="col-xl-3">
                                <div class="total-action-value--delivery js-value-delivery">
                                    @if($this->isServiceSelfPickup())
                                        <div class="delivery-content self-pickup-service">
                                            <div class="form-group">
                                                <livewire:order-meta-blocks.self-pickup-livewire
                                                    :key="'self-pickup-service_' . $updatingKey"/>
                                            </div>
                                        </div>
                                    @elseif($this->isServiceAddressDelivery())
                                        <div class="delivery-content address-delivery-service">
                                            <div>
                                                <livewire:order-meta-blocks.address-delivery-livewire
                                                    :addressOwner="$addressOwner"
                                                    :deliveryType="$deliveryType"
                                                    :key="'address-delivery-service_' . $updatingKey"/>
                                            </div>
                                        </div>
                                    @elseif($this->isServiceNovaPoshta())
                                        <div class="delivery-content nova-poshta-service">
                                            <div>
                                                <livewire:order-meta-blocks.nova-poshta-livewire
                                                    :addressOwner="$addressOwner"
                                                    :deliveryType="$deliveryType"
                                                    :key="'nova-poshta-service_' . $updatingKey"/>
                                            </div>
                                        </div>
                                    @elseif($this->isServiceSat())
                                        <div class="delivery-content sat-service">
                                            <div>
                                                <livewire:order-meta-blocks.sat-livewire
                                                    :addressOwner="$addressOwner"
                                                    :deliveryType="$deliveryType"
                                                    :key="'sat-service_' . $updatingKey"/>
                                            </div>
                                        </div>
                                    @elseif($this->isServiceDeliveryAuto())
                                        <div class="delivery-content delivery-auto-service">
                                            <div>
                                                <livewire:order-meta-blocks.delivery-auto-livewire
                                                    :addressOwner="$addressOwner"
                                                    :deliveryType="$deliveryType"
                                                    :key="'delivery-auto-service_' . $updatingKey"/>
                                            </div>
                                        </div>
                                    @elseif($this->isServiceExist())
                                        <div class="delivery-content imported-delivery-service">
                                            <div>
                                                <livewire:order-meta-blocks.imported-delivery-livewire
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
                            <div class="col-xl-3"><textarea
                                    class="total-action-value js-value-comment"
                                    wire:model.lazy="comment"
                                    placeholder="@lang('custom::site.comment_text')"></textarea>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-2">
                    @if($this->isCanShowDeliverySection())
                        <button class="button button-secondary button-block mb-2"
                                wire:click="saveOrderDraft"
                                href="javascript:void(0);">
                            @lang('custom::site.to_save')
                        </button>
                    @endif
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
