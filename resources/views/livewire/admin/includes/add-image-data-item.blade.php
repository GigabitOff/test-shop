<label for="exampleInputFile">
    @if(isset($itleImage))
    {{$itleImage}}
    @else
    Зображення
    @endif
</label>
@if(!isset($lang_img))
<div class="input-group">
    @if(isset($tmpImageDataItem[$i][$index]))
    <div class="col-3">
        <img src="{{ $tmpImageDataItem[$i][$index] ? $tmpImageDataItem[$i][$index] :  '' }}" alt="">
    </div>
    <div class="col-9">
        <button class="input-group-text float-left" type="button"
            wire:click="delTmpImageDataItem('{{$index}}','{{$i}}')">Видалити</button>
    </div>
    @elseif(isset($dataItem[$i][$index]) AND
    \Storage::disk('public')->exists($dataItem[$i][$index]))
    <div class="col-3">
        <img src="{{ \Storage::disk('public')->url($dataItem[$i][$index]) }}" alt="">
    </div>
    <div class="col-9">
        <button class="input-group-text float-left" type="button"
            wire:click="deletePhotoItem('{{$index}}','{{$i}}')">Видалити</button>
    </div>
    @else
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="pageImageMainData{{$i}}{{$index}}"
            wire:model="dataItem.{{$i}}.{{$index}}">
        <label class="custom-file-label" for="pageImage">@lang('custom::admin.Choose a photo')</label>
    </div>
    @endif

</div>
@else
<div class="input-group">
    @if(isset($tmpImageDataItem[$i][$lang_img][$index]))
    <div class="col-3">
        <img src="{{ $tmpImageDataItem[$i][$lang_img][$index] ? $tmpImageDataItem[$i][$lang_img][$index] :  '' }}"
            alt="">
    </div>
    <div class="col-9">
        <button class="input-group-text float-left" type="button"
            wire:click="delTmpImageDataItem('{{$index}}','{{$i}}')">Видалити</button>
    </div>
    @elseif(isset($dataItem[$i]['lang'][$index]) AND
    \Storage::disk('public')->exists($dataItem[$i]['lang'][$index]))
    <div class="col-3">
        <img src="{{ \Storage::disk('public')->url($dataItem[$i]['lang'][$index]) }}" alt="">
    </div>
    <div class="col-9">
        <button class="input-group-text float-left" type="button"
            wire:click="deletePhotoItemLang('{{$index}}','{{$i}}')">Видалити</button>
    </div>
    @else
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="pageImageMainData{{$i}}{{$index}}"
            wire:model="dataItem.{{$i}}.{{$lang}}.{{$index}}">
        <label class="custom-file-label" for="pageImage">@lang('custom::admin.Choose a photo')</label>
    </div>
    @endif

</div>
@endif
