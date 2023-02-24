{{--    Props: --}}
{{--    (string) model, required --}}
{{--    (string) class, optional --}}
{{--    (string) placeholder, optional --}}
{{--    (string) static, optional Фиксированный элемент, первый в списке. --}}

@php
    $varList = $model . 'List';
    $varKey = $model . 'Id';

    $list = $list ?? ($$varList) ?? [];
    $modelKey = ($$varKey) ?? '';
@endphp
<div class="drop {{$class ?? ''}} @if($modelKey) _active-close @endif" wire:ignore.self>
    <span class="drop-clear @if($modelKey) _active @endif"
          wire:click="dropFilterable('{{$model}}')"
    ></span>
    <input class="form-control drop-input js-filterable {{$inputClass ?? ''}}"
           type="text" autocomplete="off"
           wire:model.defer="{{$model}}"
{{--           value="{{$$model}}"--}}
           placeholder="{{$placeholder ?? ''}}"/>
    <div class="drop-box" wire:ignore.self>
        <div class="drop-overflow">
            <ul class="drop-list">
                @if(isset($static))
                    <li class="drop-list-item js-filterable-off"
                        onclick="@this.setFilterableSelect('{{$model}}', 'static', '{{$static}}')">{{$static}}</li>
                @endif
                @foreach($list as $id => $item)
                    @php($text = $item['text'] ?? $item)
                    @php($title = $item['title'] ?? '')
                    <li class="drop-list-item"
                        @if($title) title="{{$title}}" @endif
                        wire:click="setFilterableSelect('{{$model}}','{{$id}}', '{{$text}}')"
                    >{!! $text !!}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
