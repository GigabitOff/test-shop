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
                                   placeholder="@lang('custom::site.Email')" name="email" required
                                   autocomplete="off"><span></span>
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
                    <div class="form-group" @if(!$customer->isCustomerLegal) style="display:none;"@endif>
                        <div class="form-control-wrap">
                            <input class="form-control @if($changes->position) changed-mark @endif" type="text"
                                   style="z-index: auto;"
                                   wire:model.defer="position"
                                   placeholder="@lang('custom::site.position')"
                                   name="position"><span></span>
                        </div>
                    </div>

                    @if($customer->isCustomerSimple)
                        <div class="form-group">
                            @include('livewire.includes.dropdown-server-filterable', [
                                'name' => 'filterableCounterparty',
                                'model' => $filterableCounterparty,
                                'mode' => $filterableMode,
                                'class' => 'form-control-wrap custome-dropdown--arrow --empty',
                                'placeholder' => __('custom::site.counterparty'),
                            ])
                            @error('filterableCustomer.id')
                            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                            @enderror
                        </div>
                    @elseif($customer->isCustomerLegal)
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="mce_checkbox-admin"
                                       wire:model="is_admin" type="checkbox">
                                <label class="custom-control-label" for="mce_checkbox-admin">
                                    <span>@lang('custom::site.admin_group')</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group select2-group">
                            @include('livewire.includes.select2-revalidated', [
                                'model' => 'counterparty_ids',
                                'list' => $counterparty_list,
                                'disabled' => $is_admin,
                                'placeholder' => __('custom::site.counterparty'),
                            ])
                        </div>

                    @endif      {{-- if($customer->isCustomerLegal) --}}


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
