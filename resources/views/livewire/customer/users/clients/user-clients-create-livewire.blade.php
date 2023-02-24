<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Додати користувача<small>deks.ua</small></h5><button class="btn-close" type="button" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form action="#!">
                <div class="form-group">
                    <div class="drop --select @if(isset($data['user_role']))_selected @endif">{{--<span class="drop-clear"></span>--}}
                        <input class="form-control drop-input @error('data.user_role') is-invalid @enderror drop-input-hide" type="text" autocomplete="off" value="{{ $data['user_role'] !== null ? __('custom::admin.roles.'.$data['user_role']) : '' }}" placeholder="@lang('custom::admin.User role')" />
                        <button class="form-control drop-button" type="button">{{ $data['user_role'] !== null ? __('custom::admin.role.'.$data['user_role']) : __('custom::admin.User role') }}</button>
                        <div class="drop-box">
                            <div class="drop-overflow">
                                <ul class="drop-list">
                                    @foreach ($roles_select as $item_role)
                                        @if($item_role->name != 'api_manager')
                                            <li class="drop-list-item" onclick="@this.setUserRole('{{$item_role->name}}');">{{ __('custom::admin.role.'.$item_role->name) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @error('data.user_role')
                    <div class="is-invalid ">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="form-control @error('data.'.session('lang').'.name') is-invalid @enderror" type="text"
                           placeholder="@lang('custom::admin.clients.FIO')"
                           wire:model="data.{{session('lang')}}.name">
                    @error('data.'.session('lang').'.name')
                    <div class="is-invalid ">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="js-phone form-control @error('data.phone') is-invalid @enderror"
                           type="text"
                           placeholder="@lang('custom::admin.clients.Phone')" onchange="@this.set('phone',this.value); @this.validateDataUser();" @if(isset($data['phone'])) value="{{ mb_substr($data['phone'],2,12) }}" @else value="{{$phone}}" @endif>
                    @error('data.phone')
                    <div class="is-invalid ">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                @if(!isset($data['id']))
                    <div class="form-group">
                        <input class="form-control @error('data.email') is-invalid @enderror" type="text"
                               placeholder="@lang('custom::admin.clients.Email')"
                               wire:model="data.email">
                        @error('data.email')
                        <div class="is-invalid ">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                @endif
                <div class="form-group">
                    @include('livewire.admin.includes.select-data-arrow',[
                      'select_data_input'=>isset($select_data['city']) ? $select_data['city']: null,
                      'select_data_array'=>(isset($select_array['city']) ? $select_array['city'] : $shop_cities), 'placeholder'=>__('custom::admin.shop_cities'),
                      'index'=>'city',
                      //'searchSelectDataArrow'=>'title',
                      'show_name'=>true
                      ])

                    @error('data.city_id')
                    <div class="is-invalid ">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                {{--<div class="form-group"><input class="form-control" type="text" placeholder="Посада"></div>--}}
                <div class="form-group">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($counterparties_data_user) AND count($counterparties_data_user)>0 OR isset($data['counterparty_id']) AND $data['counterparty_id'] !==null) checked  onclick="@this.deleteDataList('null','','counterparty_id')" @else onclick = "@this.startAddCounterpaties()" @endif />
                        <span class="check__box"></span>
                        <span class="check__txt">@lang('custom::admin.Associated with a counterparty')</span>
                    </label>
                </div>

                <div  @if(isset($counterparties_data_user) AND count($counterparties_data_user)>0 OR isset($data['counterparty_id']) AND $data['counterparty_id'] !==null) @else style="display: none;" @endif >
                    <div class="form-group">
                        <div class="show-hide-box" >
                            @include('livewire.admin.includes.select-data-arrow',[
                                'select_data_input'=>(isset($select_data['counterparty_id']) ? $select_data['counterparty_id']: null),
                                'select_data_array'=>$counterparties_select, 'placeholder'=>__('custom::admin.Main counterparty'),
                                'index'=>'counterparty_id',
                                'show_name'=>true
                                ])
                        </div>
                    </div>
                    <div  class="form-group mb-0">

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

                        <script>
                            /* ---------------------------- Tags в поле input --------------------------- */

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


                        </script>
                    </div>
                </div>
                @if(isset($data['counterpaties_name']))
                <!--<div class="form-group mb-0">
                      <ul class="form-example">
                        @foreach ($data['counterpaties_name'] as $item_okpo)
                    <li>
                        <span class="label">{{$item_okpo['name']}}</span>
                            <span href="#" class="close" onclick="@this.unSetDataOKPO('{{$item_okpo['okpo']}}')">×</span>
                        </li>
                        @endforeach
                    </ul>
                  </div>-->
                @endif

                <x-modal-form id="modal-counterparty-create">
                    {{-- Форма создания контрагента --}}
                    <livewire:forms.counterparty-create-livewire/>
                </x-modal-form>

            </form>
        </div>
    </div>
</div>
