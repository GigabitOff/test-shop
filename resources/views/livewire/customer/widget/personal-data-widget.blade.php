<div class="col-xl-5 col-md-6" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500">
    <div class="lk-widjet --user-info">
        <div class="lk-widjet__head">
            <h3 class="lk-widjet__title">{!!__('custom::site.personal_data')!!}</h3>
        </div>
        <div class="lk-widjet__body">
            <ul class="widjet-user-info">
                <li class="widjet-user-info__item">
                    <div class="widjet-user-info__label">@lang('custom::site.fio')</div>
                    <div class="widjet-user-info__value">
                        <div class="widjet-user-info__input">
                            <input type="text" value="{{$user_name}}" name="fio" required>
                        </div>
                        <div class="widjet-user-info__btn"><button class="ico_edit" type="button"></button></div>
                    </div>
                </li>
                <li class="widjet-user-info__item">
                    <div class="widjet-user-info__label">@lang('custom::site.Email')</div>
                    <div class="widjet-user-info__value">
                        <div class="widjet-user-info__input">
                            <input type="text" value="{{$changes->email ?? $user_email}}" name="email"></div>
                        <div class="widjet-user-info__btn"><button class="ico_edit" type="button"></button></div>
                    </div>
                </li>
                <li class="widjet-user-info__item">
                    <div class="widjet-user-info__label">@lang('custom::site.phone')</div>
                    <div class="widjet-user-info__value">
                        <div class="widjet-user-info__input"><input class="js-phone" type="text"
                                                                    name="phone_raw" value="{{formatPhoneNumber($changes->phone ?? $user_phone)}}"
                                                                    required></div>
                        <div class="widjet-user-info__btn"><button class="ico_edit" type="button"></button></div>
                    </div>
                </li>
                <li class="widjet-user-info__item">
                    <div class="widjet-user-info__label">@lang('custom::site.choice_city')</div>
                    <div class="widjet-user-info__value">
                        <div class="widjet-user-info__input"><input type="text"
                                                                    value="{{$changes->city->name_uk ?? $user_city}}" name="city" required></div>
                        <div class="widjet-user-info__btn"></div>
                    </div>
                </li>
                @if($user_edrpou)
                    <li class="widjet-user-info__item">
                        <div class="widjet-user-info__label">@lang('custom::site.edrpou')</div>
                        <div class="widjet-user-info__value">
                            <div class="widjet-user-info__input"><input type="text" value="{{$user_edrpou}}"></div>
                            <div class="widjet-user-info__btn"></div>
                        </div>
                    </li>
                @endif
                @if($user_company)
                    <li class="widjet-user-info__item">
                        <div class="widjet-user-info__label">@lang('custom::site.company_name')</div>
                        <div class="widjet-user-info__value">
                            <div class="widjet-user-info__input"><input type="text" value="{{$user_company}}"></div>
                            <div class="widjet-user-info__btn"></div>
                        </div>
                    </li>
                @endif
                @if($user_position)
                    <li class="widjet-user-info__item">
                        <div class="widjet-user-info__label">@lang('custom::site.position')</div>
                        <div class="widjet-user-info__value">
                            <div class="widjet-user-info__input"><input type="text" value="{{$changes->position ?? $user_position}}"></div>
                            <div class="widjet-user-info__btn"><button class="ico_edit" type="button"></button></div>
                        </div>
                    </li>
                @endif
                @if($user_with_vat)
                    <li class="widjet-user-info__item">
                        <div class="widjet-user-info__label">@lang('custom::site.with_vat')</div>
                        <div class="widjet-user-info__value">
                            <div class="widjet-user-info__input"><input type="text" value="{{$user_with_vat}}"></div>
                            <div class="widjet-user-info__btn"></div>
                        </div>
                    </li>
                @endif
                <li class="widjet-user-info__item">
                    <div class="widjet-user-info__label"><a class="js-save-change" href="javascript:void(0);">@lang('custom::site.personal_data_change')</a></div>
                    <div class="widjet-user-info__value">
                        <div class="widjet-user-info__input"><a href="#m-change-password" data-bs-toggle="modal">@lang('custom::site.password_change')</a></div>
                        <div class="widjet-user-info__btn"></div>
                    </div>
                </li>

                <li class="widjet-user-info__item">
                    <div class="widjet-user-info__label">Мої адреси</div>
                    <div class="widjet-user-info__value">
                        <div class="widjet-user-info__input"><input type="text" value="вул. Мостова 24/11"></div>
                        <div class="widjet-user-info__btn"><a class="ico_edit" href="#m-change-adress" data-bs-toggle="modal"></a></div>
                    </div>
                </li>

            </ul>
            <div class="drop --select --arrow w-100">
                <spav class="drop-clear"></spav><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Вид оплати по замовченю" /><button class="form-control drop-button" type="button">@lang('custom::site.payment_type_default')</button>
                <div class="drop-box">
                    <div class="drop-overflow">
                        <ul class="drop-list">
                            <li class="drop-list-item"> {{$payment_type}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>