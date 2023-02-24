<div class="form-group">
<label>
    @if(isset($title))
    {{$title}}
    @else
    Зображення
    @endif

    @if(isset($data_file))
    @php
        $file[$index] = $data_file;
    @endphp
    @endif
</label>
<div class="input-group">
    @if(isset($file[$index]) AND
        \Storage::disk('public')->exists($file[$index]))
    <div class="col-3">
        <img src="{{ $file[$index] ? \Storage::disk('public')->url($file[$index]) : '' }}"  alt="">
    </div>
    <div class="col-9">
        <button class="input-group-text float-left" type="button" wire:click="deleteFile('{{$index}}')">Видалити</button>
    </div>
    @elseif(isset($file[$index]))
    <img src="{{ $file[$index]->temporaryUrl() ? $file[$index]->temporaryUrl() :  '' }}" alt="">
            <button class="input-group-text float-left" type="button" wire:click="deleteFile('{{$index}}')">Видалити</button>
    @else
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="pageImageMain" wire:model="file.{{$index}}">
        <label class="custom-file-label" for="pageImage">@lang('custom::admin.Choose a photo')</label>
    </div>
    @endif

</div>
</div>
