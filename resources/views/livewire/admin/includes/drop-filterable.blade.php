{{--
    Управляемый компонент выпадающего списка

    Свойства:
        'id' => '',
        'type' => 'select', // Тип select|arrow|search
        'model' => '',    // Название модели данных
        'placeholder' => '',

    Вся модель данных представлена тремя переменными начинающимися с названия полученного в свойстве model
        ${$model} = текст выбранного значения
        ${$model . 'Id'} = Ключ выбранного элемента
        ${$model . 'List'} = Ассоциативный массив доступных к вывбору элементов

    Если в списке данных есть элемент с ключом '##', то для него выставится класс 'pe-none'
        деактивирующий клик на нем.
--}}

@php
    $varList = ${$model . 'List'};
    $varKey = ${$model . 'Id'};
@endphp

<div class="drop js-free --{{$type}}" @if($id) id="{{$id}}" @endif>
    <span class="drop-clear @if($varKey) _active @endif"
          wire:click="dropFilterable('{{$model}}')"
    ></span>
    <input class="form-control drop-input js-free"
           wire:model.debounce.750ms="{{$model}}"
           placeholder="{{$placeholder}}"
           type="text" autocomplete="off" />
    <div class="drop-box" wire:ignore.self>
        <div class="drop-overflow">
            <ul class="drop-list">
                @foreach($varList as $key => $item)
                    <li class="drop-list-item @if('##' === $key) pe-none @endif"
                        wire:click="setFilterableSelect('{{$model}}', '{{$key}}', '{{$item}}')"
                    >{{$item}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
