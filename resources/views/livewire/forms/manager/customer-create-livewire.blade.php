<div class="modal-content">
    @if($isUploadLazyContent)
        <div class="modal-header">
            <h5 class="modal-title">@lang('custom::site.create_customer')<span>@lang('custom::site.on_project_domain')</span></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                    class="ico_close"></span></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="submit" class="js-form-registration" autocomplete="off">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session()->has('registration_fail'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('registration_fail') }}
                    </div>
                @endif
                <div class="form-group">
                    <div class="form-control-wrap">
                        <input class="form-control" type="text" name="fio"
                               wire:model.defer="fio"
                               placeholder="@lang('custom::site.fio')" required><span></span>
                    </div>
                    @error('fio')
                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-control-wrap">
                        <input class="js-phone form-control" type="text" name="phone_raw" autocomplete="new-password"
                               wire:model.lazy="phone_raw"
                               placeholder="@lang('custom::site.phone')" required><span></span>
                    </div>
                    @error('phone')
                    <div class="invalid-feedback" style="display:block;">
                        {{$message}}
                    </div>
                    @enderror
                    <script>
                        $('#modal-customer-create .js-phone').mask("+38/999/ 999 99 99");
                    </script>
                </div>
                <div class="form-group">
                    <div class="form-control-wrap">
                        <input class="js-email form-control" type="text"
                               wire:model.defer="email"
                               placeholder="@lang('custom::site.Email')" name="email"><span></span>
                    </div>
                    @error('email')
                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group custome-dropdown custome-dropdown--arrow --empty" id="city-selector">
                    <div class="form-control-wrap">
                        <input class="form-control" type="text" id="register-city"
                               placeholder="@lang('custom::site.choice_city')" name="city" required
                               wire:model="city"
                               onfocusout="document.customeDropdown.hideDropdown(this)"
                               autocomplete="new-password"><span></span>
                        @if(!empty($cities))
                            <div class="custome-dropdown-box"
                                 style="display:@if($mode_selecting_city)block @else none @endif ;">
                                <div class="custome-dropdown-overflow">
                                    <ul>
                                        @foreach($cities as $city)
                                            <li wire:click="selectCity({{$city->id}})"
                                                title="{{$city->name_uk}} ({{$city->district_uk}}, {{$city->region_uk}})"
                                            >{{$city->name_uk}} ({{$city->region_uk}})
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    @error('city_id')
                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox"><input
                            class="custom-control-input checkbox-privat" id="checkbox-privat"
                            wire:model.defer="legal_entity"
                            type="checkbox"><label class="custom-control-label"
                                                   for="checkbox-privat"><span>@lang('custom::site.legal_entity')</span></label>
                    </div>
                </div>
                <div class="form-group js-hide-form-group" @if(!$legal_entity) style="display:none;" @endif>
                    <div class="custom-control custom-checkbox"><input
                            class="custom-control-input checkbox-pdv" id="checkbox-pdv-1" type="checkbox"
                            wire:model.defer="with_vat"
                            checked><label class="custom-control-label"
                                           for="checkbox-pdv-1"><span>@lang('custom::site.with_vat')</span></label>
                    </div>
                </div>
                <div class="form-group js-hide-form-group" @if(!$legal_entity) style="display:none;" @endif>
                    <div class="form-control-wrap">
                        <input class="form-control legal_entity-required"
                               type="text" placeholder="@lang('custom::site.company_name')"
                               wire:model.defer="company_name"
                               @if($legal_entity) required @endif
                               name="company"><span></span>
                    </div>
                    @error('company_name')
                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group js-hide-form-group nice-select-group"
                     @if(!$legal_entity) style="display:none;" @endif >
                    <div style="display: none">
                        <select class="no-nice" name="company_type-hidden">
                            <option value="default" selected>@lang('custom::site.company_type')</option>
                            @foreach($company_types as $code => $name)
                                <option value="{{$code}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div wire:ignore>
                        <select name="company_type">
                            <option value="default" selected>@lang('custom::site.company_type')</option>
                            @foreach($company_types as $code => $name)
                                <option value="{{$code}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('company_type_id')
                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                    @enderror
                    <script>
                        $('#modal-customer-create select[name="company_type"]')
                            .niceSelect()
                            .on('change', function (e) {
                                $(e.target).find('option[value=default]').prop('disabled', true);
                                $(e.target).niceSelect('update');
                            @this.set('company_type_id', e.target.value)
                            });
                    </script>

                </div>


                <div class="form-group js-hide-form-group" @if(!$legal_entity) style="display:none;" @endif>
                    <div class="form-control-wrap" @if('custom' !== $company_type_id) style="display:none;" @endif>
                        <input class="form-control" type="text"
                               name="company_type_self"
                               wire:model.defer="company_type_self"
                               @if('custom' === $company_type_id) required @endif
                               placeholder="{{__('custom::site.company_type')}}" ><span></span>
                    </div>
                    @error('company_type_self')
                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                    @enderror
                </div>


                <div class="form-group js-hide-form-group" @if(!$legal_entity) style="display:none;" @endif>
                    <div class="form-control-wrap">
                        <input class="form-control js-okpo legal_entity-required"
                               type="text" placeholder="@lang('custom::site.edrpou')"
                               wire:model.defer="okpo_raw"
                               @if($legal_entity) required @endif
                               name="code"><span></span>
                    </div>
                    @error('okpo')
                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                    @enderror
                    <script>
                        $('#modal-customer-create .js-okpo').mask("9999 9999 99");
                    </script>
                </div>
                <div class="form-group js-hide-form-group" @if(!$legal_entity) style="display:none;" @endif>
                    <div class="form-control-wrap">
                        <input class="form-control" type="text"
                               wire:model.defer="position"
                               placeholder="@lang('custom::site.position')"
                               name="position"><span></span>
                    </div>
                </div>
                <div class="mt-5">
                    <button class="button button-secondary button-block button-lg" type="submit">
                        @lang('custom::site.save')
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
