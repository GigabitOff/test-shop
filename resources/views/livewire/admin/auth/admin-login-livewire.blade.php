<div class="login-form-wrapper">
    <div class="login-form-logo">
        <h4>Админ-панель</h4>
        <img class="logo__full" src="/img/logo-admin.svg" alt="logo">
    </div>

    <div class="login-form-toggle">
        @if(!$ip_block)
            <div class="login-form-on">
                <form class="needs-validation _pass-form"
                      id="admin-auth"
                      wire:submit.prevent="submit" novalidate>
                    <div class="form-group --phone-group">
                        <a href="#m-phone-country" data-bs-toggle="modal">
                            <div class="js-phone-country">{{ $phone_code }}</div>
                            <i class="ico_angle-down"></i>
                        </a>
                        <input wire:ignore class="js-phone-small" type="text"
{{--                               onchange="@this.set('input_phone',this.value)"--}}
{{--                               onkeypress="if(event.keyCode===13){@this.set('input_phone',this.value);}"--}}
                               id="input_ph2"
                               placeholder="@lang('custom::admin.Phone')"
                               required>
                        @if(session()->has('auth_fail'))
                            <div class="invalid-feedback" style="display:block;">{{ session('auth_fail') }}</div>
                        @endif
                        @error('phone')
                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input class="js-password form-control" type="password"
                               id="input_password"
                               placeholder="@lang('custom::admin.clients.Password')"
                               wire:model.defer="password">
                        <span class="show-password"></span>
                        <div wire:ignore
                             class="js-capslock invalid-feedback">@lang('custom::admin.Enabled CapsLock')</div>
                        <div wire:ignore
                             class="js-cirilick invalid-feedback">@lang('custom::admin.Only latin letters')</div>
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group text-center">
                        <span class="js-show-off">@lang('custom::admin.Forgot password')</span>
                    </div>

                    <div class="form-group">
                        <label class="check check--dark">
                            <input class="check__input"
                                   wire:model.defer="remember"
                                   type="checkbox">
                            <span class="check__box"></span>
                            <span class="check__txt">@lang('custom::admin.remember_not_logout')</span>
                        </label>
                    </div>

                    <div>
                        <input type="hidden" name="recaptcha_response" id="recaptchaResponse1">
                        <!-- button.button.w-100(type="submit") Авторизироваться-->
                        <script>
                            function onSubmit(token) {
                                document.getElementById("recaptchaResponse1").submit();
                            }
                        </script>
                        <!-- button.button.w-100(type="submit") Авторизироваться-->
                        <button class="button w-100" type="submit"
                                onclick="@this.set('input_phone',$('#input_ph2').val());@this.set('password',$('#input_password').val());"
                                href="page-setting-lang.html">@lang('custom::admin.Auth')</button>
                    </div>
                </form>
            </div>

            <div class="login-form-off">
                <form class="needs-validation" wire:submit.prevent="recovery" novalidate>
                    <div class="form-group">
                        <h4>@lang('custom::admin.Password recovery')</h4>
                    </div>
                    <div class="form-group --phone-group"><a href="#m-phone-country" data-bs-toggle="modal">
                            <div class="js-phone-country">{{ $phone_code }}</div>
                            <i class="ico_angle-down"></i>
                        </a>
                        <input class="js-phone-small" id="phone_input" type="text"
                               placeholder="@lang('custom::admin.Phone')"
                               onchange="@this.set('input_phone',this.value)" wire:ignore required>
                        @error('phone')
                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group text-center"><span
                            class="js-show-on">@lang('custom::admin.Remembered the password')</span></div>
                    <div class="mt-5">
                        <!-- button.button.w-100(type="submit") Отправить-->
                        <button class="button w-100">@lang('custom::admin.Send')</button>
                        @if(isset($success['recovery']))
                            <script>
                                $('#m-phone-success').modal('show');
                            </script>
                        @endif
                    </div>
                </form>
            </div>
        @else
            <div class="login-form-blocked" style="display: flex">
                <img src="/admin/assets/img/lock.svg" alt="lock">
                <h3>@lang('custom::admin.Sorry, your account has been locked for hour',['ip_block' => $ip_block])</h3>
            </div>
    </div>
    {{--
            <div class="modal-body text-center" style="color: aliceblue">
                <img src="/admin/assets/img/lock.svg" alt="lock">
            <h5>@lang('custom::admin.Sorry, your account has been locked for hour',['ip_block' => $ip_block])</h5>

            </div>--}}

    <script>
        setTimeout(() => {
            $('.home').addClass('page-is-blocked');
        }, 200);
    </script>
    @endif

    <div style="display: none" class="for_coppy_block">
        @if(isset($code_country) AND count($code_country)>0)
            @foreach ($code_country  as $item)
                <li data-bs-dismiss="modal" data-coutry-number="{{ $item }}"
                    onclick="@this.changePhoneCode('{{ $item }}')">
                    <label class="radio">
                        <input class="check__input" type="radio" name="coutry-number"
                               @if($item == $phone_code) checked @endif>
                        <span class="check__box"><span>@lang('custom::admin.Name country')</span><span>{{ $item }}</span></span>
                    </label>
                </li>
            @endforeach
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.coutry-number-list').html($('.for_coppy_block').html());
        });

        function resetDataRecovery() {
            $('#m-phone-success').modal('hide');

        @this.resetData();
        }
    </script>

</div>
