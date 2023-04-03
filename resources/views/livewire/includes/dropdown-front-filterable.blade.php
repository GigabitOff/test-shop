{{--    Props:                          --}}
{{--        (string) name,   required   --}}
{{--        (string) model,  required   --}}
{{--        (string) idInput,           --}}
{{--        (string) placeholder        --}}
{{--        (string) autocomplete       --}}
{{--        (string) class              --}}
{{--        (string) static             --}}
<?php /* $delName = [
    ['text' => 'Monday'],
    ['text' => 'Tuesday'],
    ['text' => 'Wednesday'],
    ['text' => 'Thursday'],
    ['text' => 'Friday'],
    ['text' => 'Saturday'],
    ['text' => 'Sunday']
];  */?>
<div class="drop --arrow">
    <span class="drop-clear"
          onclick="$(this).parent().find('input').focus();
          $(this).parent().find('.custome-dropdown-box').remove();
          @this.dropFilterable('{{$name}}')">
    </span>
    <input id="@if(isset($idInput)){{$idInput}}@else{{$name}}@endif"
           class="form-control drop-input" type="text"
           placeholder="{{$placeholder ?? ''}}"
           autocomplete="{{$autocomplete ?? 'new-password'}}"
           wire:model.debounce.700ms="{{$name}}.value"
           onfocusout="document.customeDropdown.hideDropdown(this)"
           name="{{$name}}">
    @empty($delName)
        @if($model['list'])
            <div class="drop-box" style="display:none;">
                <div class="drop-overflow">
                    <ul class="drop-list">
                        @foreach($model['list'] as $id => $item)
                            @php($text = $item['text'] ?? $item)
                            @php($title = $item['title'] ?? '')
                            <li class="drop-list-item" @if($title) title="{{$title}}" @endif onclick="@this.setFilterable('{{$name}}', '{{$id}}', '{{$text}}')">{{$text}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    @else
        <div class="drop-box" style="display:none;">
            <div class="drop-overflow">
                <ul class="drop-list">
                    @foreach($delName as $item)
                        @php($text = $item['text'])
                        <li class="drop-list-item"
                            onclick="@this.setFilterable('{{$name}}', '{{ $loop->index }}', '{{ $text }}')">
                            {{ $text }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endempty
</div>

