<div class="modal fade" id="saveModeReturn{{$key}}" tabindex="-1" aria-hidden="true" wire:ignore.self>

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.Confirm return') {{--<br> {{ $title }}?--}}</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h5>@lang('custom::admin.The not saved changes will not be recoverable.')</h5>
            <div class="mt-4 row">
              <div class="col-6">
                    @if(isset($on_click) OR isset($url_set))
                  <a @if(isset($on_click) AND $url_set === null) @if($on_click=='refresh;') href="" @else href="jaavascript:void(0);" data-bs-dismiss="modal" onclick="@this.{{$on_click}}" @endif @else href="{{isset($url_set) ? $url_set : ''}}" @endif class="{{ 'button w-100' }}" >@lang('custom::admin.Confirm')</a>
                    @else

                  <a href="{{ route($route) }}" class="button w-100" >@lang('custom::admin.Confirm')</a>
                    @endif
                </div>
              <div class="col-6"><button class="button button-secondary w-100" type="button" data-bs-dismiss="modal">@lang('custom::admin.Cansel')</button></div>
            </div>
          </div>
        </div>
    </div>
</div>

