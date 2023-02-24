@php
    if(!isset($kay_popap))
    $kay_popap = 'Beck';

@endphp
@if(isset($type) AND $type == 'return')
<div class="container-medium">
    <a class="page-back" {{-- @if(!isset($hide_popup) AND $canselSaveButton) --}} data-bs-target="#saveModeReturn{{$kay_popap}}" data-bs-toggle="modal"{{-- @endif--}} href="{{ route($route) }}">
        <button class="button button-accent button-small button-icon ico_arrow-left" type="button"></button>
        @if(isset($title_lang))
        {{$title_lang}}
        @else
        @lang('custom::admin.Return to list') {{($nameLive != '' ? __('custom::admin.'.$nameLive) : '')}} @endif
    </a>
</div>
@include('livewire.admin.includes.popap_return_alert',['hideFoot'=>true,'key'=>$kay_popap, 'title'=>''])

@else
<div class="d-flex justify-content-between">
    <div>
    @if(isset($route))
    <a data-bs-target="#saveModeReturn{{$kay_popap}}" data-bs-toggle="modal" href="javascript: void(0);" class="button">@if(isset($lang))@lang($lang)@else @lang('custom::admin.Add_data') @endif</a>
@include('livewire.admin.includes.popap_return_alert',['hideFoot'=>true,'key'=>$kay_popap, 'title'=>''])

    @endif

    @if(isset($button))
    <button type="button" class="btn btn-sm @if(!isset($btn))btn-primary @else {{$btn}} @endif" {{$button}}>
        @if(isset($lang))@lang($lang)@else @lang('custom::admin.Add_data') @endif
    </button>
    @endif
    </div>
</div>
@endif


