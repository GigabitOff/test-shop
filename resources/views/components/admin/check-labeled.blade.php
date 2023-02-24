@props([
    'rounded' => false,
    'caption' => '',
    'disabled' => false,
])
<label class="check @if($rounded) --radio @endif">
    <input {{ $attributes->merge(['class' => "check__input"]) }}
            @if($disabled) disabled @endif
           type="checkbox" />
    <span class="check__box"></span>
    <span class="check__txt">{{$caption}}</span>
    {{ $slot }}
</label>
