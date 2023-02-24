<div class="form-group">
    <label for="exampleInputFile">@if($itleImage) {{ $itleImage }} @else @lang('custom::admin.Documents pdf')@endif</label>
    <div class="input-group">
        @if(isset($index) AND 'docs' == $index)
            @if(isset($data[$index]) AND
            \Storage::disk('public')->exists($data[$index]))
            <a target="blunc" href="{{ \Storage::disk('public')->url($data[$index]) }}">Документ
            </a>
            <button class="input-group-text float-left" type="button" wire:click="deletePhoto('{{$index}}')">Видалити</button>
            @elseif(isset($tmpImageData[$index]))
            <a target="blunc" href="{{$tmpImageData[$index]}}">Документ
            </a>
            <button class="input-group-text float-left" type="button" wire:click="delTmpImageData('{{$index}}')">Видалити</button>

            @else
            <div class="custom-file">
                <input type="file" class="custom-file-input" wire:model="data.{{$index}}">
                <label class="custom-file-label" for="pageImage">@lang('custom::admin.Uplooad')</label>
            </div>
            @endif
        @else
        @if(isset($data[$lang]['img']) AND
        \Storage::disk('public')->exists($data[$lang]['img']))
        <a target="blunc" href="{{ \Storage::disk('public')->url($data[$lang]['img']) }}">Документ
        </a>
        <button class="input-group-text float-left" type="button"
            wire:click="deleteDocument('{{$data[$lang]['img']}}','{{$data['id']}}')">Видалити</button>
        @elseif(isset($tmpImage[$lang]))
        <a target="blunc" href="{{$tmpImage[$lang]}}">Документ
        </a>
        <button class="input-group-text float-left" type="button"
            wire:click="deleteDocument(null,'0')">Видалити</button>
        @else
        <div class="custom-file">
            <input type="file" class="custom-file-input" wire:model="data.{{$lang}}.img">
            <label class="custom-file-label" for="pageImage">@lang('custom::admin.Uplooad')</label>
        </div>
        @endif
        @endif
    </div>
</div>
