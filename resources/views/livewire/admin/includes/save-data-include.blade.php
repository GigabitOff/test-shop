@php
    if(!isset($kay_popap))
    $kay_popap = 'SaveAll';

    if(!isset($url_set))
    $url_set = null;

    if(count($this->getErrorBag()) >0 ){
    $error_data = true;
    }else{
        unset($error_data);
    }
@endphp

@error('data.'.session('lang').'.title')
        @php($error_data = true)
    @enderror
<div class="button-group page-save --all-info --btn-group">
<button class="button" type="button" onclick="topFunction(); " @if(!isset($error_data)) data-bs-target="#saveMode{{$kay_popap}}" data-bs-toggle="modal"  @endif>
   @if(isset($title_button))
   {!! $title_button !!}
   @else
   @lang('custom::admin.Save')
   @endif
</button>

@if(isset($canselSaveButton) AND !isset($onclick_cansel))

<button class="button button-secondary" type="button" data-bs-target="#saveModeReturnBeckRefresh" data-bs-toggle="modal" data-bs-toggle="modal">

   @lang('custom::admin.Cansel')

</button>


@endif

@if(isset($onclick_cansel))
<button class="button button-secondary" type="button" data-bs-target="#saveModeReturnBeckRefresh" data-bs-toggle="modal" data-bs-toggle="modal">

   @lang('custom::admin.Cansel')

</button>
@else
@php($onclick_cansel='location.reload()')
@endif


@if(isset($include_button_delete))
    <button class="button button-secondary" type="button"><span class="ico_trash"></span><span>@lang('custom::admin.Delete')</span></button>
@endif

@if(isset($include_button_status))
    <button class="button button-change @if(isset($data['status']) AND $data['status']==1)is-change @endif" type="button" onclick="@this.changeDataItem('status','{{isset($data['status']) AND $data['status']==1 ? 0 : 1}}')">@if($data['status']==0)<span class="on" >@lang('custom::admin.Show')</span>@else<span class="off">@lang('custom::admin.Hide')</span>@endif</button>
@endif


</div>
@include('livewire.admin.includes.popap_save_alert',['hideFoot'=>true,'key'=>$kay_popap, 'title'=>''])
@include('livewire.admin.includes.popap_return_alert',['hideFoot'=>true,'on_click'=>$onclick_cansel.';','url_set'=>$url_set, 'key'=>'BeckRefresh', 'title'=>''])



