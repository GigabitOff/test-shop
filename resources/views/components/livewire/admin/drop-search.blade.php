@props([
    'type' => 'select', // Тип select|arrow|search
    'list' => [],   // Массив(коллекция) данных
    'model' => '',    // Модель данных
    'placeholder' => '',
])

<div class="drop --{{$type}}" wire:ignore.self>
    <span class="drop-clear" wire:ignore.self
          wire:click="dropFilterable('{{$model}}')"
    ></span>
    <input class="form-control drop-input"
           wire:model.debounce.750ms="{{$model}}"
           placeholder="{{$placeholder}}"
           type="text" autocomplete="off" />
    <div class="drop-box" wire:ignore.self>
        <div class="drop-overflow">
            <ul class="drop-list">
                @foreach($list as $key => $item)
                    <li class="drop-list-item" wire:click="setFilterableSelect('{{$model}}', '{{$key}}', '{{$item}}')">{{$item}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
