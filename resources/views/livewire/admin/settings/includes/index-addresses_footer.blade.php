{{--<input class="form-control" type="text" placeholder="@lang('custom::admin.Enter your address')"
       wire:model.lazy="data.address.golovna_adresa.{{session('lang')}}">
<h6>@lang('custom::admin.settings.categories.address_karta')</h6>
<input class="form-control" type="text" placeholder="@lang('custom::admin.Enter your address')"
       wire:model.lazy="data.address.golovna_adresa_karta.{{session('lang')}}">--}}
       <div wire:ignore>

@livewire('admin.settings.settings-shop-index-livewire', key(time().'-addresses'))
       </div>

