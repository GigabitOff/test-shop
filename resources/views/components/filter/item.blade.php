@props([
    'title' => 'filterTitle',
    'collapsed' => true,
    'key'=> 'filterKey'
])
<div class="filter-item" id="fi-{{$key}}">
    <button class="filter-btn @if($collapsed) collapsed @endif"
            type="button" data-bs-toggle="collapse"
            aria-expanded="{{$collapsed ? 'false' : 'true'}}"
            wire:ignore.self
            data-bs-target="#fic-{{$key}}">
        <span>{{$title}}</span>
    </button>
    <div class="filter-content collapse @if(!$collapsed) show @endif"
         wire:ignore.self
         id="fic-{{$key}}">
        {{ $slot }}
    </div>
</div>
