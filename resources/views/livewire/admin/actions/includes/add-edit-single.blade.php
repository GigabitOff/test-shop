
<div class="row g-4">
    <div class="col-xl-5 col-md-12">
         <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
            @include('livewire.admin.includes.error-title')

    </div>

    <div class="col-xl-3 col-md-5">
        <input id="data_date_start_end"
               @error("data.date_start_end") style='border: 1px solid red' @enderror
               type="text" class="js-date-multy form-control"
               value="{{ isset($data['date_start']) ? $data['date_start'].' - ' : ''}}{{ isset($data['date_end']) ? $data['date_end'] : ''}}"
        />
        @include('livewire.admin.includes.calendar-form',['formId'=>'data_date_start_end','nameForm'=>'data.date_start_end','date_start'=>'data.date_start','date_end'=>'data.date_end','clear'=>false])
        <input type="hidden" wire:model="data.date_start">
        <input type="hidden" wire:model="data.date_end">
        @if($errors->hasAny(['data.date_start', 'data.date_end']))
            <div class="is-invalid d-block">@lang('custom::admin.select_interval')</div>
        @endif
    </div>
    <div class="col-xl-3 col-md-5">
        <input class="form-control @error('data.slug') is-invalid @enderror"
               type="text"
               placeholder="@lang('custom::admin.Slug')"
               wire:model.lazy="data.slug">
        @error('data.slug')
            <div class="is-invalid">{{$message}}</div>
        @enderror
    </div>
    <div class="col-xl-1 col-md-2">
        <input class="form-control" type="number"
               placeholder="@lang('custom::admin.Order')"
               wire:model.lazy="data.order">
    </div>

    <div class="col-md-4" >
        @include('livewire.admin.includes.image-data-grow',['index'=>'image_small','title'=>__('custom::admin.Preview Image'),'grow'=>false])
    </div>
    <div class="col-md-8" >
        @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Image for the card')])
    </div>

    <div class="col-12" >
        <textarea id="data-{{session('lang')}}-description" class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                wire:model.lazy="data.{{session('lang')}}.description">
                @if(isset($data[session('lang')]['description']))
                {{ $data[session('lang')]['description'] }}
                @endif
        </textarea>
    </div>

    @include('livewire.admin.includes.textarea-data-editor',['index_data'=>'body'])

<div class="form-group col-12">
    @if(isset($data[session('lang')]['keywords']) AND is_array($data[session('lang')]['keywords']))
    <div class="tagger">
        <input class="form-control" type="hidden" placeholder="Додати хештег" value="sdfsdf,dfsdfsdf" hidden="hidden">
        <ul>
            @foreach ($data[session('lang')]['keywords'] as $item_k)
            <li>
            <a href="javascript: void(0);" class="--yellow">
                <span class="label">{{$item_k}}</span>
                <span href="#" class="close" onclick="@this.unSetDataTags('keywords','{{$item_k}}')">×</span>
            </a>
            </li>
            @endforeach

            <li class="tagger-new">
                <input class="js-tags-next" onkeypress="return addNewsTags(event)" placeholder="@lang('custom::admin.Add hash tags')" >
                <div class="tagger-completion"></div>
            </li>
        </ul>
    </div>
    @else
    <input class="js-tags form-control" onprogress="" type="text" placeholder="@lang('custom::admin.Add hash tags')" value = "">
    @endif

  {{-- on_main <div class="form-group mt-4"><button class="button" type="button">Добавить</button></div>--}}
</div>

<script>
    /* ---------------------------- Tags в поле input --------------------------- */

    document.addEventListener('DOMContentLoaded', function () {

        $('.js-tags').on('keypress',function(e) {
            if(e.which == 13) {

                @this.setDataTags("keywords",$('.js-tags').val())
            }
        });
   });

   function addNewsTags(e) {
     if(e.which == 13) {

        @this.setDataTags("keywords",$('.js-tags-next').val())
        $('.js-tags-next').val('');
    }
   }


  </script>
</div>
<div class="row g-3 mt-3" wire:ignore>
    @include('livewire.admin.actions.includes.add-products')
</div>

@include('livewire.admin.includes.meta-data', ['lang'=>session('lang')])

