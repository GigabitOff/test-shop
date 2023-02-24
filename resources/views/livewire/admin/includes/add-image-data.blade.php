<div class="form-group">
<label>
    @if(isset($titleImage))
    {{$titleImage}}
    @else
    Зображення
    @endif

    @if(isset($data_file))
    @php
        $data[$index] = $data_file;
    @endphp
    @endif
</label>

<div class="input-group">

    @if(isset($data[$index]) AND
        \Storage::disk('public')->exists($data[$index]))
    <div class="col-3">

        <img src="{{ $data[$index] ? \Storage::disk('public')->url($data[$index]) : '' }}"  alt="">
    </div>
    <div class="col-9">
        <button class="input-group-text float-left" type="button" wire:click="deletePageIcon(null,'{{$data[$index]}}','{{$index}}')">Видалити</button>
    </div>
    @elseif(isset($data[$index]) AND is_object($data[$index]))
    <img src="{{ $data[$index]->temporaryUrl() ? $data[$index]->temporaryUrl() :  '' }}" alt="">
            <button class="input-group-text float-left" type="button" wire:click="deletePageIcon(null,'{{$data[$index]}}','{{$index}}')">Видалити</button>
    @else
    <div class="custom-data">
        <input type="file" class="custom-file-input" id="pageImage-{{$index}}" wire:model="data.{{$index}}">
        <label class="custom-data-label" for="pageImage-{{$index}}">@lang('custom::admin.Choose a photo')</label>
    </div>
    @endif

</div>
</div>
