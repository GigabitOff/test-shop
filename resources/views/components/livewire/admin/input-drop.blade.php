@props([
    'model',    // Модель данных
    'placeholder' => '',
])
<div class="position-relative" x-data="{value:@entangle($model)}">
    <input class="form-control" type="text"
           x-model.debounce.500ms="value"
           placeholder="{{$placeholder}}">
    <span class="drop-clear"
          :class="{'_active': value.length > 0 }"
          @click="value=''"
    ></span>
</div>
