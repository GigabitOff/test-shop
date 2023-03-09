@props([
    'list' => [],   // Массив(коллекция) данных
    'value' => '',    // Активное значение
    'model' => '',    // Модель данных
    'placeholder' => '',
    'disabled' => false,
])

<div class="drop --select" wire:ignore.self>
    <span class="drop-clear"></span>
    <input class="form-control drop-input drop-input-hide"
           type="text" autocomplete="off" />
    <button class="form-control drop-button @if($disabled) pe-none @endif"
            type="button">{{$value ?: $placeholder}}</button>
    <div class="drop-box" wire:ignore.self>
        <div class="drop-overflow">
            <ul class="drop-list">
                @foreach($list as $key => $item)
                    <li class="drop-list-item" onclick="@this.setDropValue('{{$model}}', '{{$key}}')">{{$item}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
