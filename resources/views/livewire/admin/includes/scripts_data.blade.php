<div class="modal fade" id="dellMode{{$key}}" tabindex="-1" aria-hidden="true" wire:ignore.self>
   @php
    if(!isset($js_class))
    {
        $js_class = 'js-table_new';
    }

    $hideFoot = true;
@endphp
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.Confirm delete') {{--<br> {{ $title }}?--}}</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>@lang('custom::admin.The changes will not be recoverable.')</p>
            <div class="mt-4 row">
              <div class="col-6">
                  <button class="button w-100" @if(isset($wire_click)) wire:click="{{ $wire_click }}" @endif @if(isset($on_click)) onclick="@this.{{$on_click}}; @if(!isset($hideFoot)){{--changeTableFoot(0,'{{$js_class}}');--}}@endif" @endif type="button" data-bs-dismiss="modal">@lang('custom::admin.Confirm')</button>
                </div>
              <div class="col-6"><button class="button button-secondary w-100" type="button" data-bs-dismiss="modal">@lang('custom::admin.Cansel')</button></div>
            </div>
          </div>
        </div>
    </div>
</div>

