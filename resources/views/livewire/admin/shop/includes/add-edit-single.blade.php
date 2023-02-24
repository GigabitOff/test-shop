<div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
<div class="row g-3">
            <div class="col-6">
                <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')"  wire:model="data.{{ session('lang') }}.title">
                            @include('livewire.admin.includes.error-title')
            </div>
            <div class="col-2">
                <input class="form-control" type="number" placeholder="@lang('custom::admin.Order')" wire:model="data.order">
            </div>
          </div>
<h6>@lang('custom::admin.Entering coordinates (display on the map)')</h6>
          <div class="row g-3">
            <div class="col-3">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.Latitude')"  wire:model.lazy="data.coords_latitude">
            </div>
            <div class="col-3">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.Longitude')"  wire:model.lazy="data.coords_longitude">
            </div>
          </div>
          <h6>@lang('custom::admin.Store info')</h6>
          <div class="row g-3">
            <div class="col-3">
                <div  class="show-hide-box" >
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>isset($select_data['city_id']) ? $select_data['city_id']: null,
                        'select_data_array'=>(isset($select_array['city_id']) ? $select_array['city_id'] : $shop_cities), 'placeholder'=>__('custom::admin.shop_cities'),
                        'index'=>'city_id',
                        'searchSelectDataArrow'=>'title',
                        'show_title'=>true
                        ])

                </div>
            </div>
            <div class="col-3">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.Address')"  wire:model="data.{{ session('lang')}}.address_lang">
            </div>
            <div class="col-3">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.Schedule')" wire:model="data.{{ session('lang')}}.schedule_lang">
            </div>
            <div class="col-3">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.Whours')" wire:model="data.{{ session('lang')}}.whours_lang">
            </div>
          </div>

          @if(isset($phones) AND count($phones)>0)

            <div class="row g-3 mt-1 copy-block">
              @foreach ($phones as $key_phone => $phone_item)
            <div class="col-xl-3 col-md-6 copy-item --col">
                <input class="js-phone form-control" type="text" placeholder="@lang('custom::admin.Phone')" wire:model.lazy="phones.{{ $key_phone }}" onchange="@this.set('phones.{{ $key_phone }}',this.value)" inputmode="text">

                <button class="button button-icon button-small ico_plus" type="button" wire:click="addCountPhone()"></button>

            </div>
                @endforeach
          </div>
            @else
        <div class="row g-3 mt-1 copy-block">
            <div class="col-xl-3 col-md-6 copy-item --col">
                <input class="js-phone form-control" type="text" placeholder="@lang('custom::admin.Phone')" wire:model.lazy="phones.0"  onchange="@this.set('phones.0',this.value)" inputmode="text">
                <button class="button button-icon button-small ico_plus" type="button" wire:click="addCountPhone()"></button>
            </div>
          </div>
        @endif

      {{--  <div wire:ignore>
            @livewire('admin.contucts.contuct-item-livewire', ['shop_id' => $shop_id,'hide_butt'=>true], key(time().'contuct-item-'.isset($data['id'])? $shop_id : ''))

        </div>--}}

          <div class="mt-4 page-bottom-group page-save">

              <div>
            {{--<button class="button but_1" wire:click="saveData">@lang('custom::admin.Save')</button>--}}
        @include('livewire.admin.includes.save-data-include',['wire_click'=>'saveDataSet','url_set'=>route('admin.shops.index'),'title_button'=>__('custom::admin.Save')])

              </div>
          </div>


<style>
    .but_1 {
    position:static;
    left: 99%;

    }
</style>
<script>
    document.addEventListener('click', function () {
        $('.js-phone').inputmask("+38(999) 999-99-99");
    });
</script>
