<div  class="order-form order-form--custome">
    <div class="row">
        <div class="col-xl-9">
            <div class="order-form-select">
                <div class="row g-5 mb-3">
                    <div  class="col-xl-3 col-md-6" >

                        <livewire:order-meta-blocks.recipient-selector-livewire
                            :customer="$customer"
                            :recipientName="$recipientName"
                            :key="'recipient-selector_' . $updatingKey"/>
                        @error('recipientName')
                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                        @enderror
                            <div style="display: @if(!$recipientName) none @else block @endif;">
                              &nbsp;<livewire:order-meta-blocks.recipient-phone-livewire
                                    :customer="$customer"
                                />
                            <script>
                                    var inputElement = document.getElementById('lf-phone-raw');
                                    var unmaskedValue = $(inputElement).inputmask('unmaskedvalue');
                                    $(inputElement).inputmask({
                                        mask: '+38(999)999-99-99',
                                        placeholder: '+38(___)___-__-__',
                                        onincomplete: function () {
                                            inputElement.value = '';
                                        },
                                        clearIncomplete: true
                                    });
                                    inputElement.value = '';
                                </script>
                            </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                            <livewire:order-meta-blocks.dropdown-payment-type-livewire
                                :customer="$customer"
                                :paymentId="$paymentTypeId"
                                :key="'dropdown-payment-type_' . $updatingKey"
                            />
                        <div class="order-block --customer">
                     @if($paymentTypeId != 0 and $paymentTypeId != 1 and $paymentTypeId != 3)
                                <div class="customer-content js-customer-content-1">
                                    <form action="#" autocomplete="off">
                                        <div class="form-group">
                                            <input class="form-control"
                                                   type="text"
                                                   wire:model.lazy="recipientFIO"
                                                   placeholder="ПІБ або ФОП">
                                        </div>
                                    </form>
                                </div>
                                <p>
                                <form action="#" autocomplete="off">
                                    <div class="form-group">
                                        <input class="form-control"
                                               type="text"
                                               wire:model.lazy="recipientINN"
                                               placeholder="@lang('custom::site.client_tax_number')">
                                        @error('recipientINN')
                                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                                        @enderror</div>
                                </form>
                                </p>
                          @endif
                        </div>
                    </div>
                 <div class="col-xl-3 col-md-6" style="pointer-events: @if(!$paymentTypeId) none @else block @endif;">

                        @if($updateT == 0 and $this->deliveryVars == 0)
                            <span>
                                 <livewire:order-meta-blocks.dropdown-delivery-type-livewire
                                     :deliveryTypeId="0"
                                     :key="'dropdown-delivery-type_' . rand()"
                                 />
                            </span>
                        @else
                            @switch($updateT)
                                @case(1)
                                    @once
                                        @if(!$deliveryTypeIdDu)
                                            <livewire:order-meta-blocks.dropdown-delivery-type-livewire
                                                :deliveryTypeId="1"
                                                :key="'dropdown-delivery-type_' . rand()"
                                            />
                                        @else
                                            <livewire:order-meta-blocks.dropdown-delivery-type-livewire
                                                :deliveryTypeId="$deliveryTypeIdDu"
                                                :key="'dropdown-delivery-type_' . rand()"
                                            />
                                        @endif
                                    @endonce
                                    @break
                                @case(2)
                                    @once
                                        @if(!$deliveryTypeIdDu)
                                        <livewire:order-meta-blocks.dropdown-delivery-type-livewire
                                            :deliveryTypeId="0"
                                            :key="'dropdown-delivery-type_' . rand()"
                                        />
                                        @else
                                            <livewire:order-meta-blocks.dropdown-delivery-type-livewire
                                                :deliveryTypeId="$deliveryTypeIdDu"
                                                :key="'dropdown-delivery-type_' . rand()"
                                            />
                                        @endif
                                    @endonce
                                    @break
                                @case(3)
                                    @once
                                        @if(!$deliveryTypeIdDu)
                                            <livewire:order-meta-blocks.dropdown-delivery-type-livewire
                                                :deliveryTypeId="0"
                                                :key="'dropdown-delivery-type_' . rand()"
                                            />
                                        @else
                                            <livewire:order-meta-blocks.dropdown-delivery-type-livewire
                                                :deliveryTypeId="$deliveryTypeIdDu"
                                                :key="'dropdown-delivery-type_' . rand()"
                                            />
                                        @endif
                                    @endonce
                                    @break
                                @default
                            @endswitch
                        @endif
                        <div class="order-block --delivery" >
                     @if($this->isServiceSelfPickup() and  $paymentTypeId == 1 or $this->isServiceSelfPickup() and  $paymentTypeId == 2 and !empty($deliveryTypeIdDu) or $this->isServiceSelfPickup() and  $paymentTypeId == 3 and !empty($deliveryTypeIdDu))
                                <div class="delivery-content js-delivery-content-1">
                                    <form action="#" autocomplete="off">
                                        <div class="form-group">
                                            <livewire:order-meta-blocks.self-pickup-livewire
                                                :key="'self-pickup-service_' . $updatingKey"/>
                                        </div>
                                    </form>
                                </div>
                       @elseif($this->isServiceAddressDelivery() and !empty($paymentTypeId) and  !empty($paymentTypeId))

                                <div class="delivery-content js-delivery-content-2">
                                    <form action="#">
                                        <div class="form-group">
                                            <livewire:order-meta-blocks.address-delivery-livewire
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'address-delivery-service_' . $updatingKey"/>
                                        </div>
                                    </form>
                                </div>
                                </span>
                            @elseif($this->isServiceNovaPoshta() and $deliveryTypeIdDu)
                                <div class="delivery-content js-delivery-content-3">
                                    <form action="#" autocomplete="off">
                                        <div class="form-group">
                                            <livewire:order-meta-blocks.nova-poshta-livewire
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'nova-poshta-service_' . $updatingKey"/>
                                        </div>
                                    </form>
                                </div>
                            @elseif($this->isServiceSat() and $deliveryTypeIdDu)
                                <div class="delivery-content js-delivery-content-4">
                                    <form action="#" autocomplete="off">
                                        <div class="form-group">
                                            <livewire:order-meta-blocks.sat-livewire
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'sat-service_' . $updatingKey"/>
                                        </div>
                                    </form>
                                </div>
                            @elseif($this->isServiceDeliveryAuto() and $deliveryTypeIdDu)
                                <div class="delivery-content js-delivery-content-5">
                                    <form action="#" autocomplete="off">
                                        <div class="form-group">
                                            <livewire:order-meta-blocks.delivery-auto-livewire
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'delivery-auto-service_' . $updatingKey"/>
                                        </div>
                                    </form>
                                </div>
                            @elseif($this->isServiceExist() and $deliveryTypeIdDu and !empty($paymentTypeId) )
                                <div class="delivery-content js-delivery-content">
                                    <form action="#" autocomplete="off">
                                        <div class="form-group">
                                            <livewire:order-meta-blocks.imported-delivery-livewire
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'imported-delivery-service_' . rand()"
                                                wire:model="name"
                                            />
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" style="pointer-events: @if($updateT == 0) none @else block @endif;">
                        <button class="js-add-comment order-form-btn"
                                type="button"> @lang('custom::site.Comment')</button>
                        <div class="order-block --comment "
                             @if($this->isHideCommentSection()) style="display: none" @endif>
            <textarea class="form-control" wire:model.lazy="comment"
                      placeholder="@lang('custom::site.comment_text')"></textarea>

                        </div>
                    </div>

                </div>
            </div>
        </div>
       <div class="col-xl-3 text-end">
            <button class="button-accent" type="button"
                    wire:click="createOrder">@lang('custom::site.Confirm')</button>
        </div>
    </div>
</div>


