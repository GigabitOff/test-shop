<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.user_add')<small>@lang('custom::site.on_project_domain')</small></h5><button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit" id="formAddLkCustomerForm">

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

            <div class="form-group">
                <label class="check">
                    <input class="check__input" type="checkbox" @if(isset($counterparties_data_user) AND count($counterparties_data_user)>0 OR isset($data['counterparty_id']) AND $data['counterparty_id'] !==null) checked  onclick="@this.deleteDataList('null','','counterparty_id')" @else onclick = "@this.startAddCounterpaties()" @endif />
                    <span class="check__box"></span>
                    <span class="check__txt">@lang('custom::admin.Associated with a counterparty')</span>
                </label>
            </div>

            <div class="form-group">
                <label class="check">
                    <input class="check__input" type="checkbox" wire:model.defer="checkbox_admin" />
                    <span class="check__box"></span>
                    <span class="check__txt">@lang('custom::admin.Admin group')</span></label>
                @error('checkbox_admin')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>

            <div  @if(isset($counterparties_data_user) AND count($counterparties_data_user)>0 OR isset($data['counterparty_id']) AND $data['counterparty_id'] !==null) @else style="display: none;" @endif >
                <!--<div class="form-group">

                    <div class="show-hide-box" >
                        @include('livewire.admin.includes.select-data-arrow',[
                            'select_data_input'=>(isset($select_data['counterparty_id']) ? $select_data['counterparty_id']: null),
                            'select_data_array'=>$counterparties_select, 'placeholder'=>__('custom::admin.Main counterparty'),
                            'index'=>'counterparty_id',
                            'show_name'=>true
                            ])
                    </div>
                </div>-->
                <div  class="form-group">

                    @if(isset($data['counterpaties_name']) AND $data['counterpaties_name'] != '')
                        <div class="tagger">
                            <input class="form-control" type="hidden" placeholder="Додати хештег" value="sdfsdf,dfsdfsdf" hidden="hidden">
                            <ul>
                                @foreach ($data['counterpaties_name'] as $item_okpo)
                                    <li>
                                        <a href="javascript: void(0);" class="--yellow">
                                            <span class="label">{{$item_okpo['name']}}</span>
                                            <span href="#" class="close" onclick="@this.unSetDataOKPO('{{$item_okpo['okpo']}}')">×</span>
                                        </a>
                                    </li>
                                @endforeach
                                @if(isset($this->data['no_counterpaties_name']) AND count($this->data['no_counterpaties_name'])>0)
                                    @foreach ($data['no_counterpaties_name'] as $item_no_okpo)
                                        <li>
                                            <a href="javascript: void(0);">
                                                <span class="label">{{$item_no_okpo }}</span>
                                                <span href="#" class="close" onclick="@this.unSetDataOKPO('{{$item_no_okpo}}')">×</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif

                                <li class="tagger-new">
                                    <input class="js-tags-next" onkeypress="return addNewTags(event)" placeholder="@lang('custom::admin.Related counterparty')" >
                                    <div class="tagger-completion"></div>
                                </li>
                            </ul>
                        </div>
                    @else
                        <input class="js-tags form-control" onkeypress="return addNewTagsFirst(event,this.value)" type="text" placeholder="@lang('custom::admin.Related counterparty')" value = "">
                    @endif

                    {{-- <div class="form-group mt-4"><button class="button" type="button">Добавить</button></div>--}}

                </div>
            </div>

            <div class="form-group" wire:ignore.self>
                <input class="form-control" type="text"
                       id="fr_position"
                       wire:model.defer="position"
                       placeholder="@lang('custom::site.position')"
                       name="position">
            </div>

            <div class="form-group">
                <button class="button-accent w-100"
                        onclick="document.addLkCustomerForm.submitClick()"
                        type="submit">@lang('custom::site.add')</button>
            </div>

        </form>
    </div>
</div>
@push('custom-scripts')
    <script>


        function addNewTags(e) {
            if(e.which == 13) {
                @this.setDataOKPO($('.js-tags-next').val())
                $('.js-tags-next').val('');
            }
        }
        function addNewTagsFirst(e,value) {
            if(e.which == 13) {
                @this.setDataOKPO(value)
                $('.js-tags').val('');
            }
        }

        $('form#formAddLkCustomerForm').keypress(function (e) {
            var keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode == 13)
            {
                e.preventDefault();
                //$('form#login').submit();
                return false;
            }
        });

        document.addLkCustomerForm = {
            submitClick: () => {
                const form = document.getElementById('formAddLkCustomerForm');
                if (form.checkValidity()) {
                    @this.set('phoneRaw', $(form).find('input[name=phone]').val());
                }
            }
        }

    </script>
@endpush
