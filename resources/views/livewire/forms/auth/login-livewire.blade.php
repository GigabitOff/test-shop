<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.login_to_account')
            <small>@lang('custom::site.on_project_domain')</small>
        </h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form class="_pass-form needs-validation" wire:submit.prevent="submit" novalidate>
                @if(session()->has('auth_fail'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('auth_fail') }}
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
                    <input class="form-control js-no-cyrillic "
                           id="lf-password" type="password"
                           wire:model.defer="password"
                           placeholder="@lang('custom::site.password')"
                           name="password" required><span class="show-password"></span>
                    <div class="invalid-feedback">@error('password'){{$message}}@enderror</div>
                </div>
                <div class="links-group">
                    <a href="#m-password-recovery" data-bs-toggle="modal"
                       data-bs-dismiss="modal">@lang('custom::site.Request password again')</a>
                    <a href="#m-registration" data-bs-toggle="modal"
                       data-bs-dismiss="modal">@lang('custom::site.registration')</a>
                </div>
                <div class="form-group mt-4">
                    <button class="button-accent w-100"
                            onclick="@this.set('phoneRaw', $(this).closest('form').find('input[name=phone]').val())"
                            type="submit">@lang('custom::site.to_login')</button>
                    <div class="login-btns-group">
                        <button class="ico_google"
                                onclick="document.loginForm.showNeedCredentialsMessage()"
                                type="button">Google</button>
                        <button class="ico_apple"
                                onclick="document.loginForm.showNeedCredentialsMessage()"
                                type="button">Apple Id</button>
                        <button class="ico_bank"
                                onclick="document.loginForm.showNeedCredentialsMessage()"
                                type="button">Банк id</button>
                    </div>
                </div>

                @if(!app()->isProduction())
                    <div class="form-group mt-2 mb-0">
                        <input class="form-control @error('userId') is-invalid @enderror"
                               onkeypress="if(event.keyCode===13){@this.loginUser(this.value);event.stopPropagation()}"
                               placeholder="UserID + Enter = Login"
                               autocomplete="off" id="autohash"
                               type="text" name="autohash">
                        @error('userId')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                @endif

            </form>
    </div>
</div>

@push('custom-scripts')
    <script>
        // ToDo: сделать форму отображения скидок товаров
        document.loginForm = {
            showNeedCredentialsMessage: () => {
                Livewire.emit('eventShowDialogMessage', {
                    'title': '@lang("custom::site.login_to_account")',
                    'message': 'Ожидаются доступы для подключения сервиса.',
                    'buttons': [
                        {
                            'text': '@lang('custom::site.agree')',
                            'actions': [
                                {
                                    'type': 'showModal',
                                    'target': 'm-login'
                                }
                            ]
                        }
                    ]
                })
            }
        }

        //# sourceURL=login-livewire.js
    </script>
@endpush
