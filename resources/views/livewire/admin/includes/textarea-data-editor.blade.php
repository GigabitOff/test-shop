@php
    if(!isset($index_data)){
        $index_data = 'body';
    }
@endphp
<div class="col-12" wire:ignore wire:key="first-ignore-{{$index_data}}-{{session('lang')}}">

        <textarea id="data-{{session('lang')}}-{{$index_data}}" class="form-control" rows="3" placeholder="{{ isset($placeholder) ? $placeholder : __('custom::admin.Description') }}"
                wire:model.lazy="data.{{session('lang')}}.{{$index_data}}">
                @if(isset($data[session('lang')][$index_data]))
                {{ $data[session('lang')][$index_data] }}
                @endif
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'data-'.session('lang').'-'.$index_data, 'nameForm'=>'data.'.session('lang').'.'.$index_data])
</div>
