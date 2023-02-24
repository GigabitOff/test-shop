<div class="modal fade" id="saveMode{{$key}}" tabindex="-1" aria-hidden="true" wire:ignore.self>

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.Confirm save') {{--<br> {{ $title }}?--}}</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mt-4 row">
              <div class="col-6">
                  <button class="button w-100" @if(isset($on_click) AND $on_click == 'refresh') href="#" @endif

                  @if(isset($on_click) AND $on_click !== 'refresh') onclick="topFunction();  @this.{{$on_click}}" @endif
                  @if(isset($on_click_many)) onclick="topFunction();  @this.{{$on_click_many[0]}}; @this.{{$on_click_many[1]}};
                  @if(isset($on_click_many[2])) @this.{{$on_click_many[2]}} @endif"
                  @endif type="button" data-bs-dismiss="modal"

                  @if(isset($wire_click)) wire:click="{{ $wire_click }}" onclick="topFunction();" @endif >@lang('custom::admin.Confirm')</button>
                </div>
              <div class="col-6"><button class="button button-secondary w-100" type="button" data-bs-dismiss="modal">@lang('custom::admin.Cansel')</button></div>
            </div>
          </div>
        </div>
    </div>
</div>

