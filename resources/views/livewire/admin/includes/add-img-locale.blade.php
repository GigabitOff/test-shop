<label for="exampleInputFile">
    @if(isset($titleImage))
    {{$titleImage}}
    @else
    Зображення локальної мови
    @endif</label>
<div class="input-group row">
    @if(isset($data[$lang][$index]) AND
        \Storage::disk('public')->exists($data[$lang][$index]))
    <div class="col-3">
        <img src="{{ \Storage::disk('public')->exists($data[$lang][$index]) }}" alt="">
    </div>
    <div class="col-9">
        <button class="input-group-text float-left" type="button" wire:click="delTmpImageLang">Видалити</button>
    </div>
    @elseif(isset($data[$lang][$index]) AND
    is_object($data[$lang][$index]))
    <div class="col-3">
        <img src="{{ $data[$lang][$index]->temporaryUrl() ? $data[$lang][$index]->temporaryUrl() :  ''}}" alt="">
    </div>
    <div class="col-9">
        <button class="input-group-text float-left" type="button" wire:click="deletePhotoLocale('{{$lang}}', '{{$index}}')">Видалити</button>
    </div>
    @else
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="pageImage" wire:model="data.{{$lang}}.{{$index}}">
        <label class="custom-file-label" for="pageImage">@lang('custom::admin.Choose a photo')</label>
    </div>
    @endif
</div>
