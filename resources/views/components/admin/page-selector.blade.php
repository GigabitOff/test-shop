@props([
    'direction' => '', // открывать вверх = drop--up
    'paginator' => null,
    'list' => [],
])
<div class="@if($paginator->total() <= ($list[0] ?? 0)) d-none @endif">
    <div class="drop --arrow {{$direction}}" wire:ignore.self>
        <button class="form-control drop-button" type="button">{{$paginator->perPage()}}</button>
        <div class="drop-box" wire:ignore.self>
            <div class="drop-overflow">
                <ul class="drop-list">
                    @foreach($list as $value)
                        <li class="drop-list-item"
                            wire:click="setPerPageValue({{$value}}, '{{$paginator->getPageName()}}')">{{$value}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
