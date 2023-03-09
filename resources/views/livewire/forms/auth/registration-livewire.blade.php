<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.registration')
            <small>@lang('custom::site.on_project_domain')</small>
        </h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form class="_hide-box" wire:submit.prevent="submit" id="formRegistration" autocomplete="off">
            @if(session()->has('registration_fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('registration_fail') }}
                </div>
            @endif

            <div class="form-group">
                <input class="form-control @error('fio') is-invalid @enderror"
                       id="fr_fio"
                       type="text" name="fio"
                       wire:model.defer="fio"
                       placeholder="@lang('custom::site.fio')" required>
                <div class="invalid-feedback">@error('fio'){{$message}}@enderror</div>
            </div>

            <div class="form-group">
                <input class="js-phone form-control @error('phone') is-invalid @enderror"
                       id="fr_phone"
                       type="text" name="phone" autocomplete="off" value="{{$phoneRaw}}"
                       onchange="@this.set('phoneRaw', this.value)"
                       placeholder="@lang('custom::site.phone')" required>
                <div class="invalid-feedback">@error('phone'){{$message}}@enderror</div>
            </div>

            <div class="form-group">
                <input class="form-control @error('email') is-invalid @enderror"
                       id="fr_email" type="email"
                       @if($do_registration_complete) disabled @endif
                       wire:model.defer="email"
                       placeholder="@lang('custom::site.Email')" name="email">
                <div class="invalid-feedback">@error('email'){{$message}}@enderror</div>
            </div>

            <div class="form-group">
                @include('livewire.includes.drop-filterable-back', [
                    'class' => '--arrow',
                    'inputClass' => 'js-no-digits',
                    'model' => 'filterableCity',
                    'placeholder' => __('custom::site.choice_city'),
                ])
                @error('filterableCityId')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group --small">
                <label class="check">
                    <input class="_hide-checkbox check__input"
                           id="fr_legal-entity"
                           wire:model="legal_entity"
                           type="checkbox">
                    <span class="check__box"></span>
                    <span class="check__txt">@lang('custom::site.legal_entity')</span>
                </label>
            </div>

            <div class="form-group _hide" wire:ignore.self>
                <label class="check">
                    <input class="check__input" id="checkbox-pdv-1" type="checkbox"
                           wire:model.defer="with_vat" checked>
                    <span class="check__box"></span>
                    <span class="check__txt">@lang('custom::site.with_vat')</span>
                </label>
            </div>

            <div class="form-group _hide" wire:ignore.self>
                <input class="form-control @error('company_name') is-invalid @enderror"
                       type="text"
                       wire:model.defer="company_name"
                       placeholder="@lang('custom::site.company_name')"
                       name="company">
                <div class="invalid-feedback">@error('company_name'){{$message}}@enderror</div>
            </div>

            <div class="form-group _hide" wire:ignore.self>
                @include('livewire.includes.drop-filterable-front', [
                    'class' => '--arrow',
                    'model' => 'filterableCompanyType',
                    'placeholder' => __('custom::site.company_type'),
                ])
                @error('filterableCompanyTypeId')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group _hide" wire:ignore.self>
                <div @if($this->isNotCustomCompanyType()) style="display: none;" @endif>
                    <input class="form-control @error('customCompanyType') is-invalid @enderror"
                           id="fr_custom-company-type"
                           wire:model.defer="customCompanyType"
                           placeholder="@lang('custom::site.company_type')"
                           type="text" name="customCompanyType">
                    <div class="invalid-feedback">@error('customCompanyType'){{$message}}@enderror</div>
                </div>
            </div>

            <div class="form-group _hide" wire:ignore.self>
                <input class="form-control js-okpo @error('okpo') is-invalid @enderror"
                       id="fr_okpo"
                       onchange="@this.set('okpoRaw', this.value)"
                       placeholder="@lang('custom::site.edrpou')"
                       type="text" value="{{$okpoRaw}}" name="okpo">
                <div class="invalid-feedback">@error('okpo'){{$message}}@enderror</div>
            </div>

            <div class="form-group _hide" wire:ignore.self>
                <input class="form-control" type="text"
                       id="fr_position"
                       wire:model.defer="position"
                       placeholder="@lang('custom::site.position')"
                       name="position">
            </div>

            <div class="form-group">
                <label class="check">
                    <input class="check__input"
                           wire:model.defer="privacy_policy"
                           id="checkbox-politic" type="checkbox">
                    <span class="check__box"></span>
                    <span class="check__txt">
                        @lang('custom::site.agreement_with')
                        <a href="#">@lang('custom::site.privacy_policy')</a>
                    </span>
                </label>
                @error('privacy_policy')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>

            @if(!$legal_entity)
                <div class="form-group">
                    <button class="button-accent w-100"
                            {{--                        onclick="@this.set('phoneRaw', $(this).closest('form').find('input[name=phone]').val())"--}}
                            onclick="document.registrationForm.submitClick()"
                            type="submit">@lang('custom::site.send_password')</button>
                    <div class="login-btns-group">
                        <button class="ico_google"
                                onclick="document.registrationForm.showNeedCredentialsMessage()"
                                type="button">Google
                        </button>
                        <button class="ico_apple"
                                onclick="document.registrationForm.showNeedCredentialsMessage()"
                                type="button">Apple Id
                        </button>
                        <button class="ico_bank"
                                onclick="document.registrationForm.showNeedCredentialsMessage()"
                                type="button">Банк id
                        </button>
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>

@push('custom-scripts')
    <script>
        document.addEventListener('restoreRegistrationForm', () => {
            $('#fr_legal-entity').trigger('change');
        });

        document.registrationForm = {
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
            },
            submitClick: () => {
                const form = document.getElementById('formRegistration');
                if (form.checkValidity()) {
                @this.set('phoneRaw', $(form).find('input[name=phone]').val());
                @this.set('okpoRaw', $(form).find('input[name=okpo]').val());
                }
            }
        }

        //# sourceURL=registration-livewire.js
    </script>
@endpush

