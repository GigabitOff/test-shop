<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.Found cheaper')<span>@lang('custom::site.on site')</span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit">
            <div class="form-group">
                <div class="form-control-wrap">
                    <input class="form-control" type="text"
                           name="url"
                           wire:model.defer="link"
                           placeholder="@lang('custom::site.Product link')"
                           required>
                    <span></span>
                </div>
                @error('link')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="form-control-wrap">
                    <textarea class="form-control" name="messages"
                              wire:model.defer="message"
                              placeholder="@lang('custom::site.message')"
                              required></textarea>
                    <span></span>
                </div>
                @error('message')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-5">
                <button class="button button-secondary button-block button-lg"
                        type="submit">@lang('custom::site.Send')</button>
            </div>
        </form>
    </div>
</div>
