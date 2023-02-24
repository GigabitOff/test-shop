<div class="form-group">
    <label >@if(isset($title)) {{ $title }} @else @lang('custom::admin.File')@endif</label>

    @if(isset($data_file))
     @php
        $file[$index] = $data_file;
    @endphp
    @elseif(isset($data) AND !is_array($data))

    @php
        $file[$index] = $data;
    @endphp
    @endif
    <div class="input-group">
        @if(isset($file[$index]) AND
        \Storage::disk('public')->exists($file[$index]))
            <a target="blunc" href="{{ \Storage::disk('public')->url($file[$index]) }}">@lang('custom::admin.File')
            </a>
            <button class="input-group-text float-left" type="button" @if(isset($disable) AND $disable == true) disabled @endif wire:click="deleteFile('{{$index}}')">Видалити</button>
        @elseif(isset($file[$index]))
            <a target="blunc" href="{{$file[$index]->path()}}">{{$file[$index]->getClientOriginalName()}} @lang('custom::admin.File')
            </a>
            <button class="input-group-text float-left" type="button" wire:click="deleteFile('{{$index}}')">Видалити</button>
        @else
            <div class="custom-file">
                <input type="file" class="custom-file-input" wire:model="file.{{$index}}">
                <label class="custom-file-label">@lang('custom::admin.Uplooad')</label>
            </div>
        @endif

    </div>
</div>
