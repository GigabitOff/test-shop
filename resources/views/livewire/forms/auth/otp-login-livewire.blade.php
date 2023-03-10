<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.login_to_account')
            <small>@lang('custom::site.on_project_domain')</small>
        </h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form class="_pass-form needs-validation" wire:submit.prevent="submit" novalidate>
                @if(session()->has('otp_code_fail'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->pull('otp_code_fail') }}
                    </div>
                @endif
                @if(session()->has('otp_code_resent'))
                    <div class="alert alert-warning" role="alert">
                        {{ session()->pull('otp_code_resent') }}
                    </div>
                @endif
                <div class="form-group">
                    <input class="js-phone form-control @error('phone') is-invalid @enderror"
                           id="lf-phone-raw" type="text"
                           onchange="@this.set('phoneRaw', this.value)"
                           wire:model.defer="phoneRaw"
                           name="phone" placeholder="@lang('custom::site.phone')" required>
                    <div class="invalid-feedback">@error('phone'){{$message}}@enderror</div>
                </div>
                <div class="form-group">
                    <input class="form-control js-no-cyrillic @error('code') is-invalid @enderror"
                           id="lf-code" type="text"
                           wire:model.defer="code"
                           placeholder="@lang('custom::site.otp_code')"
                           name="code" required>
                    <div class="invalid-feedback">@error('code'){{$message}}@enderror</div>
                </div>
                <div class="links-group">
                    <a href="javascript:void(0);" wire:click="resendCode">@lang('custom::site.otp_code_resend')</a>
                </div>
                <div class="form-group mt-4">
                    <button class="button-accent w-100"
                            onclick="@this.set('phoneRaw', $(this).closest('form').find('input[name=phone]').val())"
                            type="submit">@lang('custom::site.to_login')</button>
                </div>
            </form>
    </div>
</div>
