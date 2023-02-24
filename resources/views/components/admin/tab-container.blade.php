@props([
    'active' => false,
    'key' => '',
])
<div class="tab-pane fade @if($active)show active @endif"
     wire:ignore.self
     id="{{$key}}-tab" role="tabpanel">
    <div class="container-large">
        {{ $slot }}
    </div>
</div>
