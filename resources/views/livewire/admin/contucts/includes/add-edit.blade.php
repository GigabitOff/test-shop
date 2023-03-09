 <div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
<div class="container-xsmall">

<div class="row g-3">

    <div class="col-md-12">

        @include('livewire.admin.includes.select-data-arrow',[
            'select_data_input'=>isset($select_data['city_id']) ? $select_data['city_id']: null,
            'select_data_array'=>(isset($select_array['city_id']) ) ? $select_array['city_id'] : $select_cities,
            'placeholder'=>__('custom::admin.shop_cities'),
            'index'=>'city_id',
            'searchSelectDataArrow' => 'title',
            'show_title'=>true,


        ])
    </div>
    @if($select_shops AND count($select_shops)>0 AND isset($select_data['city_id']))
    <div class="col-md-12">
        @include('livewire.admin.includes.select-data-arrow',[
            'select_data_input'=>isset($select_data['shop_id']) ? $select_data['shop_id']: null,
            'select_data_array'=>(isset($select_array['shop_id']) ) ? $select_array['shop_id'] : $select_shops,
            'placeholder'=>__('custom::admin.Filials'),
            'index'=>'shop_id',
            'searchSelectDataArrow' => 'title',
            'show_title'=>true,


        ])
    </div>
    @endif
    <div class="col-md-12">
        <input class="form-control @error('data.'.session('lang').'.title') is-invalid @endif" type="text" placeholder="@lang('custom::admin.Subdivision name')" wire:model="data.{{ session('lang') }}.title">
            @include('livewire.admin.includes.error-title')

    </div>

              <div class="col-md-12">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.Surname I.O')." wire:model.lazy="data.{{ session('lang') }}.name">

            </div>
              <div class="col-md-12">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.Position')" wire:model.lazy="data.{{ session('lang') }}.posada"></div>

                <div class="col-md-12" >
                    <div class="row">
                        <div class="col-md-4">
                            @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Photo')])
                        </div>
                    </div>

                </div>
              <div class="col-md-12">
                <div class="row">
                        <div class="col-md-6">
              <div class="copy-block">
              @foreach ($phones as $key_phone => $phone_item)
                <div class="form-group copy-item @if($key_phone>0) --new @endif">
                    <input class="js-phone form-control" type="text" placeholder="@lang('custom::admin.Phone')" wire:model.lazy="phones.{{ $key_phone }}" wire:ignore onclick="showMasc(this)" onchange="@this.set('phones.{{ $key_phone }}',this.value)">
                    @if($key_phone==0)
                    <button class="button button-icon button-small ico_plus" type="button"  wire:click="addCountPhone"></button>
                    @else
                    <button class="button button-icon button-small ico_close" type="button" wire:click="removeCountPhone({{ $key_phone }})"></button>
                    @endif
                </div>
                @endforeach
              </div>
              <div class="copy-block">
              @foreach ($emails as $key_email => $email_item)
                <div class="form-group copy-item @if($key_email>0) --new @endif">
                    <input class="form-control" type="text" placeholder="@lang('custom::admin.E-mail')" wire:model.lazy="emails.{{ $key_email }}" onchange="@this.set('emails.{{ $key_email }}',this.value)">
                    @if($key_email==0)
                    <button class="button button-icon button-small ico_plus" type="button"  wire:click="addCountEmail"></button>
                    @else
                    <button class="button button-icon button-small ico_close" type="button" wire:click="removeCountEmail({{ $key_email }})"></button>
                    @endif
                </div>
                @endforeach
              </div>
              </div>
                    </div>
              </div>
            </div>
            </div>
<div class="col-md-12" wire:ignore>
    @livewire('admin.contucts.popup-contuct-item-livewire',['item_id'=>$item_id], key('user-contuct-item-livewire'))
</div>
<div class="col-md-12" wire:ignore>
    @livewire('admin.users.user-contuct-item-livewire',['item_id'=>$item_id], key('user-contuct-item-livewire'))
</div>


 <div class="mt-4">


        @include('livewire.admin.includes.save-data-include',['on_click'=>'saveData()','url_set'=>route('admin.contucts.index'),'title_button'=>__('custom::admin.Save')])

            </div>
<script>
        function showMasc(item) {
            $(item).inputmask({"mask": "+38(999) 999-99-99"});

        }

</script>
