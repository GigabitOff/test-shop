<div class="modal-content">
    @if($isUploadLazyContent)
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.invite_user')<span>@lang('custom::site.on_project_domain')</span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit">
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="overflow-box">
                <div class="js-copy-trading-point-fields">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input class="js-phone form-control" type="text"
                                   wire:model.debounce.700ms="phone_raw"
                                   name="phone_raw" placeholder="@lang('custom::site.phone')"
                                   required autocomplete="off"><span></span>
                        </div>
                        <script>
                            $('#modal-customer-invitation .js-phone').mask("+99 /999/ 999 99 99");
                        </script>
                        @error('phone')
                        <div class="invalid-feedback" style="display:block;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input class="form-control" type="text" name="name" disabled
                                   value="{{$result}}"
                                   ><span></span>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button class="button button-secondary button-block button-lg"
                                @if(!$recipient_id) disabled @endif
                                type="submit">@lang('custom::site.invite')
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>
