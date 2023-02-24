<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.contract_add')<span>@lang('custom::site.on_project_domain')</span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit">
            <div class="overflow-box">
                <div class="js-copy-trading-point-fields">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input class="form-control" type="text"
                                   wire:model.defer="name"
                                   name="name-tt" placeholder="@lang('custom::site.contract_name')"
                                   required><span></span></div>
                        @error('name')
                        <div class="invalid-feedback" style="display:block;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input class="form-control" type="text"
                                   wire:model.defer="address"
                                   name="address" placeholder="@lang('custom::site.address')"
                                   required><span></span></div>
                        @error('address')
                        <div class="invalid-feedback" style="display:block;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input class="js-phone form-control" type="text"
                                   wire:model.defer="phone_raw"
                                   name="phone_raw" placeholder="@lang('custom::site.phone')"
                                   required autocomplete="off"><span></span>
                        </div>
                        @error('phone')
                        <div class="invalid-feedback" style="display:block;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
        <div class="mt-5">
            <button class="button button-secondary button-block button-lg" type="submit">@lang('custom::site.save')
            </button>
        </div>
    </div>
</div>
