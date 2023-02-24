@props([
    'title' => '',
])
<div class="filter-drop">
    <button class="filter-drop-btn" type="button">
        <span class="filter-drop-val">{{$title}}</span>
        <span class="filter-drop-arw"></span></button>
    <div class="filter-drop-box">
        {{ $slot }}
    </div>
</div>
