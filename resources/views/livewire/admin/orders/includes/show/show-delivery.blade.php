<div class="order">
    <div class="row">
        <div class="col-md-5">
            <div class="info-item" wire:ignore>
                <div class="info-item__label">@lang('custom::admin.Departure date')</div>
                   {{-- <div class="info-item__data">
                        {{ formatDate($dataPage->departue_at,'d.m.Y') }}
                    </div>--}}
                <input id="data_departue_at" @error("data.departue_at") style='border: 1px solid red' @enderror type="text" class="js-date form-control" value="{{ isset($data['departue_at']) ? $data['departue_at'] : ''}}" />
        @include('livewire.admin.includes.calendar-new-form',['formId'=>'data_departue_at','nameForm'=>'data.departue_at','date_start'=>'data.departue_at','single'=>'single','clear'=>false])
        <input type="hidden" wire:model="data.departue_at">
                </div>
                <div class="info-item"  wire:ignore>
                    <div class="info-item__label">@lang('custom::admin.Delivery date')</div>
                    {{--<div class="info-item__data">{{ formatDate($dataPage->date_delivery,'d.m.Y H:i') }}</div>--}}
                    <input id="data_date_delivery" @error("data.date_delivery") style='border: 1px solid red' @enderror type="text" class="js-date form-control" value="{{ isset($data['date_delivery']) ? $data['date_delivery'] : ''}}" />
        @include('livewire.admin.includes.calendar-new-form',['formId'=>'data_date_delivery','nameForm'=>'data.date_delivery','date_start'=>'data.date_delivery','single'=>'single','timePicker'=>true,'clear'=>false])
        <input type="hidden" wire:model="data.date_delivery">
                </div>
                @if($dataPage->deliveryAddress)
                      <div class="info-item">
                        <div class="info-item__label">@lang('custom::admin.Delivery service')</div>
                        <div class="info-item__data">
                            {{ isset($dataPage->deliveryAddress->deliveryType) ?$dataPage->deliveryAddress->deliveryType->name : ''}}
                        </div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">@lang('custom::admin.Delivery address')</div>
                        <div class="info-item__data">{{ $dataPage->deliveryAddress->additional_data}}{{--, ул. Машиностороительная 69, кв. 36--}}</div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">@lang('custom::admin.The contact person')</div>
                        <div class="info-item__data">
                            {{ $dataPage->fio }} {{ $dataPage->phone }}</div>
                      </div>
                @endif
                    </div>
                    <div class="col-md-7">
                      <div class="info-item">
                        <div class="info-item__label">@lang('custom::admin.Delivery man')</div><button class="select-rules" data-bs-target="#m-select-delivery-man" data-bs-toggle="modal">Фамилия И.О.</button>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Номер ТТН </div>
                        <div class="info-item__data">
                          <div class="row g-3">
                            <div class="col-lg-8"><input class="form-control" type="text" placeholder="ТТН"></div>
                            <div class="col-lg-4"> <button class="button w-100" type="text">Подтвердить</button></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
