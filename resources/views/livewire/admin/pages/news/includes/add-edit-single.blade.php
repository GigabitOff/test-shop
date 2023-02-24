
<div class="row">
    <div class="col-9">
         <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">

            @include('livewire.admin.includes.error-title')
    </div>
    <div class="col-3">
        <input id="data_date_start_end" @error("data.date_start_end") style='border: 1px solid red' @enderror type="text" class="js-date form-control" value="{{ isset($data['created_at']) ? $data['created_at'] : ''}}" />
        @include('livewire.admin.includes.calendar-form',['formId'=>'data_date_start_end','nameForm'=>'data.date_start_end','date_start'=>'data.created_at','single'=>'single','clear'=>false])
        <input type="hidden" wire:model="data.date_start">
    </div>
</div>
<div class="row mt-3">
    <div class="col-10"><input class="form-control" type="text" placeholder="Slug" wire:model="slug"></div>
    <div class="col-2"><input class="form-control" type="number" placeholder="@lang('custom::admin.Order')" wire:model="data.order"></div>
</div>
<div class="row mt-4">
    <div class="col-4" >
        @include('livewire.admin.includes.image-data-grow',['index'=>'image_small','title'=>__('custom::admin.Preview Image'),'grow'=>false])
    </div>
    <div class="col-8" >
        @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Image for the card')])
    </div>
</div>
<div class="row mt-4">
    @include('livewire.admin.includes.textarea-data-editor')
</div>
<div  class="row mt-4" wire:key="script-prod" wire:ignore.self>
<div class="form-group">
    @if(isset($data[session('lang')]['keywords']) AND is_array($data[session('lang')]['keywords']) AND count($data[session('lang')]['keywords']) >0 )
    <div class="tagger">
    <input class="form-control" type="hidden" placeholder="Додати хештег" value="" hidden="hidden">
    <ul>
        @if(isset($data[session('lang')]['keywords']))
        @foreach ($data[session('lang')]['keywords'] as $item_k)
        <li>
        <a href="javascript: void(0);" class="--yellow">
            <span class="label">{{$item_k}}</span>
            <span href="#" class="close" onclick="@this.unSetDataTags('keywords','{{$item_k}}')">×</span>
        </a>
        </li>
        @endforeach
        @endif

        <li class="tagger-new">
            <input class="js-tags-next" onkeypress="return addNewTags(event);" placeholder="@lang('custom::admin.Add hash tags')" >
            <div class="tagger-completion"></div>
        </li>
    </ul>
</div>
    @else
    <input class="js-tags-first form-control" onkeypress="return addNewTagsFirst(event);" type="text" placeholder="@lang('custom::admin.Add hash tags')" value = "">
    @endif

  {{-- <div class="form-group mt-4"><button class="button" type="button">Добавить</button></div>--}}
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

   function addNewTags(e) {
     if(e.which == 13) {
        //alert('ddd');
        @this.setDataTags("keywords",$('.js-tags-next').val())
        $('.js-tags-next').val('');
    }
   }

   function addNewTagsFirst(e) {
     if(e.which == 13) {
        //alert('ddd');
        @this.setDataTags("keywords",$('.js-tags-first').val())
        $('.js-tags-first').val('');
    }
   }


  </script>
</div>

    @include('livewire.admin.includes.meta-data', ['lang'=>session('lang')])

