 <div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
<form action="#!">
    <div class="form-group">
        <input class="form-control @error('data.'.session('lang').'.title') is-invalid @endif" type="text" placeholder="@lang('custom::admin.Subdivision name')" wire:model="data.{{ session('lang') }}.title">
        @php
$error_data_title_lang = "";
    if(!isset($index))
    $index = 'title';
@endphp

@foreach ($languages as $lang_it)
            @error('data.'.$lang_it->lang.'.'.$index)

            @php($title_error = $message)
            @php($error_data_title_lang .= "[$lang_it->lang]")
            @php($error_data_title = true)
            @enderror
            @endforeach

            @if(isset($error_data_title))
            <div class="is-invalid ">
                {{ $title_error }}

                @if(isset($title_error) AND isset($data[session('lang')]) AND isset($data[session('lang')][$index]) AND strlen($data[session('lang')][$index])-2>4)
                {{ $error_data_title_lang }}
                @endif
            </div>
            @endif
    </div>

              <div class="form-group">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.Surname I.O')." wire:model.lazy="data_parent.{{ session('lang') }}.title">

            </div>
              <div class="form-group"><input class="form-control" type="text" placeholder="@lang('custom::admin.Position')" wire:model.lazy="data_parent.{{ session('lang') }}.posada"></div>
              <div class="row mt-4 mb-4">
                <div class="col-5" >
                    @include('livewire.admin.includes.image-data-grow',['index'=>'image_parent','title'=>__('custom::admin.Photo')])
                </div>
            </div>
              <div class="copy-block">
              @foreach ($phones as $key_phone => $phone_item)
                <div class="form-group copy-item">
                    <input class="js-phone form-control" type="text" placeholder="@lang('custom::admin.Phone')" wire:model.lazy="phones.{{ $key_phone }}" wire:ignore onclick="showMasc(this)" onchange="@this.set('phones.{{ $key_phone }}',this.value)">
                    @if($key_phone==0)
                    <button class="button button-icon button-small ico_plus" type="button"  wire:click="addCountPhone"></button>
                    @endif
                </div>
                @endforeach
              </div>
              <div class="copy-block">
              @foreach ($emails as $key_email => $email_item)
                <div class="form-group copy-item">
                    <input class="form-control" type="text" placeholder="@lang('custom::admin.E-mail')" wire:model.lazy="emails.{{ $key_email }}" onchange="@this.set('emails.{{ $key_phone }}',this.value)">
                    @if($key_email==0)
                    <button class="button button-icon button-small ico_plus" type="button"  wire:click="addCountEmail"></button>
                    @endif
                </div>
                @endforeach
              </div>
              <div class="mt-4">
               
            @if(!isset($error_data_title))

                <button class="button w-100" type="button" @if($item_id)  onclick="@this.updateDataTmp() " data-bs-dismiss="modal" aria-label="Close" @else onclick="@this.createDataTmp()"  @endif >@lang('custom::admin.Save')</button>
            @endif
            </div>
            </form>


<script>
        function showMasc(item) {
            $(item).inputmask({"mask": "+38(999) 999-99-99"});

        }

</script>
