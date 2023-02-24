@props([
    'active' => false,
    'link' => '',
    'confirm' => false,
])

@php
    $classes = $active
                ? 'is-active'
                : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}
    href="{{$confirm ? 'javascript: void(0);' : $link}}"
   @if($confirm && $link)
       onclick="document.menuLeft.showConfirmPopup('{{$link}}')"
   @endif
    >
    {{ $slot }}
</a>
