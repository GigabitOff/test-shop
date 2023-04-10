<div>
    @if($filterableSaved['list'])
        <div class="form-group" id="filterable-saved">
            @include('livewire.includes.dropdown-front-filterable', [
                'name' => 'filterableSaved',
                'model' => $filterableSaved,
                'static' => __('custom::site.another_address'),
                'placeholder' => __('custom::site.select_address'),
            ])
        </div>
    @endif
        <div class="form-group">
            @include('livewire.includes.dropdown-server-filterable', [
                'name' => 'filterableCity',
                'model' => $filterableCity,
                'mode' => $filterableMode,
                'class' => 'custome-dropdown--arrow --empty',
                'placeholder' => __('custom::site.choice_city'),
            ])
            @error('data.city_id')
            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
            @enderror
        </div>
    <form action="javascript:void(0);">
        <div class="js-group-option group-option"><label>@lang('custom::site.delivery_type')</label>
            <div class="form-group">
                <div class="form-check"><label
                        class="check d-flex"><input
                            class="check__input"
                            type="radio"
                            wire:model="deliveryTarget"
                            value="address"
                            @if($this->isDeliverySaved()) disabled @endif
                            name="delivery--type-delivery">
                        <span class="check__box"></span>
                        <span class="check__txt">@lang('custom::site.delivery_by_courier')</span></label>
                </div>
                <div class="form-check"><label
                        class="check d-flex"><input
                            class="check__input"
                            type="radio"
                            wire:model="deliveryTarget"
                            value="department"
                            @if($this->isDeliverySaved()) disabled @endif
                            name="delivery--type-delivery">
                        <span class="check__box"></span>
                        <span class="check__txt">@lang('custom::site.delivery_in_department')</span></label>
                </div>
            </div>
            @if($this->isDeliveryNewToAddress())
                <div class="js-option1 group-option-item">
                    <div class="form-group">
                       <input class="form-control" type="text"
                               wire:model.lazy="street"
                               placeholder="@lang('custom::site.street')">
                        @error('data.street_name')
                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text"
                               wire:model.lazy="house"
                               placeholder="@lang('custom::site.house')">
                        @error('data.dom')
                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text"
                               wire:model.lazy="korpus"
                               placeholder="@lang('custom::site.house_item')">
                        @error('data.korpus')
                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text"
                               wire:model.lazy="office"
                               placeholder="@lang('custom::site.office_flat')">
                        @error('data.office')
                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            @elseif($this->isDeliveryNewToDepartment())

                <div class="form-group">
                    @include('livewire.includes.dropdown-front-filterable', [
                      'name' => 'filterableDepartment',
                      'model' => $filterableDepartment,
                      'placeholder' => __('custom::site.select_department'),
                    ])
                    @error('data.otdel_guid')
                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                    @enderror
                </div>
            @elseif($this->isDeliverySaved())
                <div class="form-group">
                    <textarea class="total-action-value" disabled>{{$filterableSaved['value']}}</textarea>
                </div>
            @endif
        </div>
    </form>
</div>

