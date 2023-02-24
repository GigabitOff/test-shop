<div class="modal-content">
    {{-- @if($isUploadLazyContent) --}}
        <div class="modal-header">
            <h5 class="lk-widjet__title">@lang('custom::site.personal_data_change')<span>@lang('custom::site.on_project_domain')</span></h5>
            <button class="btn-close" type="button" data-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="submit" class="js-form-change-data"
                  id="formPersonalDataEdit">  {{-- Далее id-префикс fpde --}}
                @if($data_on_moderation)
                    <div class="alert alert-info" role="alert">
                        @lang('custom::site.personal_data_on_moderation')
                    </div>
                @endif
                @if(session()->has('fail'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('fail') }}
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="form-group">
                    <div class="form-control-wrap">
                        <input class="form-control @if($changes->name ?? false) changed-mark @endif"
                               wire:model.defer="fio"
                               type="text" name="fio"
                               placeholder="@lang('custom::site.fio')" required><span></span>
                    </div>
                    @error('fio')
                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-control-wrap">
                        <input class="js-phone form-control @if($changes->phone ?? false) changed-mark @endif" type="text"
                               wire:model.lazy="phone_raw"
                               name="phone_raw" placeholder="@lang('custom::site.phone')"
                               required><span></span>
                    </div>
                    @error('phone')
                    <div class="invalid-feedback" style="display:block;">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-control-wrap">
                        <input class="js-email form-control @if($changes->email ?? false) changed-mark @endif" type="text"
                               wire:model.defer="email"
                               placeholder="@lang('custom::site.Email')" name="email"><span></span>
                    </div>
                </div>
                <div class="form-group custome-dropdown custome-dropdown--arrow --empty">
                    <div class="form-control-wrap">
                        <input class="form-control @if($changes->sity_id ?? false) changed-mark @endif" type="text"
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
                    <div class="form-control-wrap">
                        <input class="form-control @if($changes->position ?? false) changed-mark @endif" type="text"
                               style="z-index: auto;"
                               wire:model.defer="position"
                               placeholder="@lang('custom::site.position')"
                               name="position"><span></span>
                    </div>
                </div>

                <div class="form-group nice-select-group @if($changes->payment_type_id ?? false) changed-mark @endif">
                    <select name="type-payment-hidden" style="display: none">
                        <option value="0" @if($payment_type_id) disabled @endif>@lang('custom::site.payment_type')</option>
                        @foreach($payment_types as $type)
                            <option @if($payment_type_id === $type->id) selected @endif
                            value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                    <div wire:ignore>
                        <select name="type-payment">
                            <option value="0" @if($payment_type_id) disabled @endif>@lang('custom::site.payment_type')</option>
                            @foreach($payment_types as $type)
                                <option @if($payment_type_id === $type->id) selected @endif
                                value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        <script>
                            $('#modal-personal-data-edit select[name="type-payment"]')
                                .niceSelect()
                                .on('change', function (e) {
                                    $(e.target).find('option[value=0]').prop('disabled', true);
                                    @this.set('payment_type_id', e.target.value)
                                });
                        </script>
                    </div>
                </div>
                <div class="mt-5">
                    <button class="button button-secondary button-block button-lg"
                            type="submit">@lang('custom::site.save')
                    </button>
                </div>
            </form>
        </div>
    {{-- @endif --}}
</div>

