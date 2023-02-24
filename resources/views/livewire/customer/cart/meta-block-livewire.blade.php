<div class="order-form order-form--custome">
  <div class="row">
    <div class="col-xl-9">
      <div class="order-form-select">
        <div class="row g-5 mb-3">

          <div class="col-xl-3 col-md-6">
            <livewire:order-meta-blocks.dropdown-payment-type-livewire
                                :customer="$customer"
                                :paymentId="$paymentTypeId"
                                :key="'dropdown-payment-type_' . $updatingKey"/>

          </div>

          <div class="col-xl-3 col-md-6">

            <livewire:order-meta-blocks.dropdown-delivery-type-livewire
                        :deliveryTypeId="$deliveryType->id ?? 0"
                        :key="'dropdown-delivery-type_' . $updatingKey"/>

            <div class="order-block --delivery">
            @if($this->isServiceSelfPickup())
              <div class="delivery-content js-delivery-content-1">
                <form action="#" autocomplete="off">                                    
                  <div class="form-group">
                      <livewire:order-meta-blocks.self-pickup-livewire
                          :key="'self-pickup-service_' . $updatingKey"/>
                  </div>
                </form>
              </div>
              @elseif($this->isServiceAddressDelivery())
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
              @elseif($this->isServiceNovaPoshta())
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
              @elseif($this->isServiceSat())

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
              @elseif($this->isServiceDeliveryAuto())
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
              @elseif($this->isServiceExist())

              <div class="delivery-content js-delivery-content">
                <form action="#" autocomplete="off">
                <div class="form-group">
                      <livewire:order-meta-blocks.imported-delivery-livewire
                                                :addressOwner="$addressOwner"
                                                :deliveryType="$deliveryType"
                                                :key="'imported-delivery-service_' . $updatingKey"/>
                </div>
                </form>
              </div>

              @endif
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
                <livewire:order-meta-blocks.recipient-selector-livewire
                        :customer="$customer"
                        :recipientName="$recipientName"
                        :key="'recipient-selector_' . $updatingKey"/>
                  @error('recipientName')
                  <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                  @enderror

             <div class="order-block --customer"> 
            @if($customer->isCustomerSimple && $this->isPaymentTypeInvoice())
              <div class="customer-content js-customer-content-1">
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
              </div>
              @endif
            </div>
          </div>
          <div class="col-xl-3 col-md-6"><button class="js-add-comment order-form-btn" type="button">
          @lang('custom::site.Comment')</button>
            <div class="order-block --comment" @if($this->isHideCommentSection()) style="display: none" @endif>
            <textarea class="form-control" wire:model.lazy="comment"
                                placeholder="@lang('custom::site.comment_text')"></textarea></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 text-end"><button class="button-accent" type="button"
      wire:click="createOrder">@lang('custom::site.Confirm')</button></div>
  </div>
</div>
