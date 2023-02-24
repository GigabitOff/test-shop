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

    @if($this->isDeliverySaved())
        @foreach(['city_name', 'address_full', 'departure_at'] as $key)
            @if($data[$key])
                <div class="form-group" id="delivery-saved-{{$key}}">
                    <div class="total-action-value">{{$data[$key]}}</div>
                </div>
            @endif
        @endforeach
    @else
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
        <div class="form-group">
            <input class="departure-datepicker form-control" type="text"
                   id="departure_at"
                   value="{{$departureAt}}"
                   placeholder="@lang('custom::site.departure_date')">
            <script>
                document.initDeliveryDatepicker = function () {
                    $('.departure-datepicker').datepicker({
                        autoClose: true,
                        range: false,
                        dateFormat: '{{config('app.date_formats.datepicker')}}',
                        minDate: new Date(),    // from now
                        onSelect: function (selectedDate) {
                            const dateSelect = selectedDate.split(' - ');
                        @this.set('departureAt', dateSelect[0]);
                        },
                    });
                }
                @if(isLivewireRequest())
                document.initDeliveryDatepicker();
                @else
                document.addEventListener('DOMContentLoaded', function ($) {
                    document.initDeliveryDatepicker();
                });
                @endif
            </script>
        </div>
    @endif
    <div class="form-group"><span>@lang('custom::site.delivery_amount')</span></div>
</div>
