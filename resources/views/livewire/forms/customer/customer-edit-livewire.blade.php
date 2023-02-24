<div class="modal-content">
    @if($isUploadLazyContent)
        <div class="modal-header">
            <h5 class="modal-title">@lang('custom::site.user_edit')<span>@lang('custom::site.on_project_domain')</span></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                    class="ico_close"></span></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="submit" autocomplete="off">
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
                @if(session()->has('fail_upload'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('fail_upload') }}
                    </div>
                    {{-- Не отображаем содержимое окна при ошибке загрузки--}}
                @else
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input class="form-control @if($changes->name) changed-mark @endif"
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
                            <input class="js-phone form-control @if($changes->phone) changed-mark @endif" type="text"
                                   wire:model.lazy="phone_raw"
                                   name="phone_raw" placeholder="@lang('custom::site.phone')"
                                   required autocomplete="off"><span></span>
                        </div>
                        <script>
                            $('#modal-customer-edit .js-phone').mask("+38/999/ 999 99 99");
                        </script>
                        @error('phone')
                        <div class="invalid-feedback" style="display:block;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input class="js-email form-control @if($changes->email) changed-mark @endif" type="text"
                                   wire:model.defer="email"
                                   placeholder="@lang('custom::site.Email')" name="email" required autocomplete="off"><span></span>
                        </div>
                        @error('email')
                        <div class="invalid-feedback" style="display:block;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group custome-dropdown custome-dropdown--arrow --empty">
                        <div class="form-control-wrap">
                            <input class="form-control @if($changes->city_id) changed-mark @endif" type="text"
                                   placeholder="{{__('custom::site.choice_city')}}" name="user_city" required
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
                            <input class="form-control @if($changes->position) changed-mark @endif" type="text"
                                   style="z-index: auto;"
                                   wire:model.defer="position"
                                   placeholder="@lang('custom::site.position')"
                                   name="position"><span></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox"><input
                                class="custom-control-input" id="checkbox-admin"
                                wire:model="is_admin"
                                type="checkbox"><label class="custom-control-label"
                                                       for="checkbox-admin"><span>@lang('custom::site.admin_group')</span></label>
                        </div>
                    </div>

                    @if(!$is_admin)
                        <div class="form-group select2-group" id="counterparty-select2-group">
                            <div style="display: none">
                                <select name="counterparty-hidden" multiple="multiple" >
                                    @foreach($counterparties as $id => $name)
                                        <option value="{{$id}}"
                                                @if(in_array($id, $counterparty_ids)) selected @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div wire:ignore>
                                <select name="counterparty" id="fce_counterparty"
                                        multiple="multiple"
                                        data-params="{{ json_encode(['placeholder'=> __('custom::site.counterparty')]) }}">
                                    @foreach($counterparties as $id => $name)
                                        <option value="{{$id}}"
                                                @if(in_array($id, $counterparty_ids)) selected @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                                <script>
                                    $('#modal-customer-edit select[name="counterparty"]')
                                        .select2({placeholder:"@lang('custom::site.counterparty')"})
                                        .on('change', function (e) {
                                        @this.set('counterparty_ids', $(e.target).val())
                                        });
                                    //# sourceURL=modal-customer-edit_counterparty_inline.js
                                </script>
                            </div>
                        </div>
                        @error('counterparty_id')
                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                        @enderror
                    @endif

                    @if($contracts && !$is_admin)
                        <div class="form-group select2-group" multiple="multiple">
                            <div style="display: none">
                                <select name="contract-hidden" multiple="multiple">
                                    @foreach($contracts as $id => $name)
                                        <option value="{{$id}}"
                                                @if(in_array($id, $contract_ids)) selected @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div wire:ignore>
                                <select name="contract" multiple="multiple" data-params="{{ json_encode(['placeholder'=> __('custom::site.contract')]) }}">
                                    @foreach($contracts as $id => $name)
                                        <option value="{{$id}}"
                                                @if(in_array($id, $contract_ids)) selected @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                                <script>
                                    $('#modal-customer-edit select[name="contract"]')
                                        .select2({placeholder:"@lang('custom::site.contract')"})
                                        .on('change', function (e) {
                                        @this.set('contract_ids', $(e.target).val())
                                        });
                                    //# sourceURL=modal-customer-edit_contract_inline.js
                                </script>
                            </div>
                            @error('contract_ids')
                            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="mt-5">
                        <button class="button button-secondary button-block button-lg"
                                type="submit">@lang('custom::site.save')
                        </button>
                    </div>
                @endif
            </form>
        </div>
    @endif
</div>
