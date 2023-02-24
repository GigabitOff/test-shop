@props([
    'active' => false,
    'key' => '',
])
<li class="nav-item" role="presentation">
    <button class="nav-link @if($active) active @endif"
            wire:ignore.self
            wire:click="activateTab('{{$key}}')"
            data-bs-toggle="tab"
            data-bs-target="#{{$key}}-tab"
            type="button" role="tab">
        {{ $slot }}
    </button>
</li>
