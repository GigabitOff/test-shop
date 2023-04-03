<div wire:ignore>
{{--@livewire('admin.partials.header-livewire', key(time().'header-livewire'))--}}
</div>
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.counterparties.index'])

@if(isset($data['id']))
<h4 class="text-center text-lg-start">ID {{ $data['id'] }}</h4>
@endif

<ul class="nav nav-tabs tabs-catalog-inner" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($changeLangTabItem)  AND $changeLangTabItem==='all-info')active @endif" type="button"  onclick="@this.changeLangTab('all-info')"  tabindex="-1">@lang('custom::admin.Main data')</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($changeLangTabItem)  AND $changeLangTabItem==='person')active @endif" type="button"  onclick="@this.changeLangTab('person')" tabindex="-1">@lang('custom::admin.founder')</button>
    </li>
    @if(isset($item_id))
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($changeLangTabItem)  AND $changeLangTabItem==='contracts')active @endif" type="button"  onclick="@this.changeLangTab('contracts')" tabindex="-1">@lang('custom::admin.Agreements')</button>
    </li>
    @endif
</ul>
<div class="product-info tab-content --partner-inner">
    <div class="tab-pane fade @if(isset($changeLangTabItem)  AND $changeLangTabItem==='all-info') active show @endif"  role="tabpanel">
        <div class="row g-4">
            <div class="col-xl-6">
                <form action="#!">
                    <div class="row g-3">
                        <div class="col-12" >
                        <div   wire:ignore.self >
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['shop_id']) ? $select_data['shop_id']: null),
                        'select_data_array'=>isset($select_array['shop_id']) ? $select_array['shop_id'] : null,
                        'placeholder'=>__('custom::admin.Filial'),
                        //'drop_class'=> '--search',
                        //'locale'=>session('lang'),
                        'index'=>'shop_id',
                       // 'title_select' => (isset($select_data['shop_id']) ? $select_data['shop_id']['input']: null),
                        'show_title' => true,
                        'disabled_select'=>true,
                        ])

                      </div>
                      </div>
                      <div class="col-12" >
                        <div   wire:ignore.self >
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['type_id']) ? $select_data['type_id']: null),
                        'select_data_array'=>isset($select_array['type_id']) ? $select_array['type_id'] : null,
                        'placeholder'=>__('custom::admin.Counterparty type'),
                        //'drop_class'=> 'drop-input',
                        //'locale'=>session('lang'),
                        'index'=>'type_id',
                        'disabled_select'=>true,
                        'show_name'=>true
                        ])

                      </div>
                      </div>
                      <div class="col-12" >
                        <div   wire:ignore.self >
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['form']) ? $select_data['form']: null),
                        'select_data_array'=>isset($select_array['form']) ? $select_array['form'] : null,
                        'placeholder'=>__('custom::admin.Forms'),
                        //'drop_class'=> '--search',
                        'locale'=>session('lang'),
                        'index'=>'form',
                        'disabled_select'=>true,
                        'show_no_index'=>true
                        ])

                      </div>

                {{--<div class="drop --select @if(isset($data['form_id']))_selected @endif"><span class="drop-clear"></span>
                    <input class="form-control drop-input @error('data.form_id') is-invalid @enderror drop-input-hide" type="text" autocomplete="off" value="{{isset($data['form_id']) AND isset($counterparty_forms[$data['form_id']]) ? $counterparty_forms[$data['form_id']]['name'] : '' }}" placeholder="@lang('custom::admin.Forms')" />
                    <button class="form-control drop-button" type="button">{{ (isset($data['form_id']) AND isset($show_counterparty[$data['form_id']])) ? $show_counterparty[$data['form_id']]['name'] : __('custom::admin.Forms') }}</button>

                    <div class="drop-box">
                      <div class="drop-overflow">
                        <ul class="drop-list">
                           @foreach ($counterparty_forms as $item_form)
                          <li class="drop-list-item" onclick="@this.set('data.form_id',{{ $item_form->id }})">{{ $item_form->name }}</li>

                            @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                  --}}
                  @error('data.user_role')
                    <div class="is-invalid ">
                        {{$message}}
                    </div>
                    @enderror
                      </div>
                      <div class="col-12">
                        <input class="form-control @error('data.name') is-invalid @enderror"  type="text" wire:model.lazy="data.name" placeholder="@lang('custom::admin.Name company')">
                        @error('data.name')
                        <div class="is-invalid ">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
                      <div class="col-12">
                        <input class="form-control @error('data.okpo') is-invalid @enderror"  type="text" wire:model.lazy="data.okpo" placeholder="@lang('custom::admin.counterparty.okpo')">
                        @error('data.okpo')
                        <div class="is-invalid ">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
                      <div class="col-12">
                        <input class="form-control"  type="text" wire:model.lazy="data.created_at" placeholder="@lang('custom::admin.Date register')" ></div>
                      <div class="col-12"><input class="form-control"  type="text" wire:model.lazy="data.activity_type" placeholder="@lang('custom::admin.Employment type')"></div>
                      <div class="col-12"><input class="form-control"  type="text" wire:model.lazy="data.owner" placeholder="@lang('custom::admin.Owner')"></div>
                      <div class="col-12"><input class="form-control"  type="text" wire:model.lazy="data.authorized_capital" placeholder="@lang('custom::admin.Authorized capital')"></div>
                      {{--<div class="col-12"><input class="form-control"  type="text" wire:model.lazy="data.inn" placeholder="ИНН"></div>
                      <div class="col-12"><input class="form-control"  type="text" wire:model.lazy="data.date_registration_inn" placeholder="@lang('custom::admin.Date register okpo')"></div>--}}
                      <div class="col-12"><input class="form-control"  type="text" wire:model.lazy="data.form_nalog" placeholder="@lang('custom::admin.form_nalog')"></div>
                      <div class="col-12 show-hide">
                        <label class="check" onclick="@this.changeDataItem('is_nds','{{(isset($data['is_nds']) AND $data['is_nds']==1) ? 0 : 1}}')">
                        <input class="check__input" @if(isset($data['is_nds']) AND $data['is_nds']==1) checked @endif  type="checkbox">
                        <span class="check__box"></span>
                        <span class="check__txt">@lang('custom::admin.Pay NDS')</span></label>
                    </div>
                    <div class="show-hide-box" @if(isset($data['is_nds']) AND $data['is_nds']==1) style="display: block;"  wire:ignore @endif>
                        <div class="col-12"><input class="form-control" value="{{ @$data['nds_certificate'] }}" type="text" onchange="@this.set('data.nds_certificate',this.value)" placeholder="@lang('custom::admin.nds_certificate')"></div>
                      </div>
                      {{--<div class="col-12">
                        <input class="form-control"  type="text" wire:model.lazy="data.phone"  onchange="@this.set('data.phone',this.value);" @if(isset($data['phone']))  @else value="" @endif  placeholder="@lang('custom::admin.Phone')"></div>
                      <div class="col-12"><input class="form-control"  type="text" wire:model.lazy="data.email" placeholder="@lang('custom::admin.E-mail')"></div>--}}
                      <div class="col-12">
                        <div class="form-group-box">
                            <input class="form-control"  type="text" wire:model.lazy="data.ur_address" placeholder="@lang('custom::admin.ur_address')">
                            <input class="form-control"  type="text" wire:model.lazy="data.fact_address" placeholder="@lang('custom::admin.fact_address')">
                            <input class="form-control"  type="text" wire:model.lazy="data.post_address" placeholder="@lang('custom::admin.post_address')"></div>
                      </div>
                      <div class="col-12">
                        <div class="form-group-box">
                            <input class="form-control"  type="text" wire:model.lazy="data.iban" placeholder="@lang('custom::admin.iban')">
                            <input class="form-control"  type="text" wire:model.lazy="data.bank_name" placeholder="@lang('custom::admin.bank_name')">
                            <input class="form-control"  type="text" wire:model.lazy="data.mfo" placeholder="@lang('custom::admin.MFO')">
                        </div>
                      </div>
                      <hr>
                      <div class="col-12">
                        <div   wire:ignore.self >
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['manager_id']) ? $select_data['manager_id']: null),
                        'select_data_array'=>$managers_select,
                        'placeholder'=>__('custom::admin.Main manager'),
                        'drop_class'=> '--search',
                        'index'=>'manager_id',
                        'disabled_select'=>true,
                        'show_name'=>true
                        ])

                    </div>
                        {{--<div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input"  type="text"  autocomplete="off" placeholder="Основной менеджер">
                          <div class="drop-box" style="display: none;">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Менеджер 1</li>
                                <li class="drop-list-item">Менеджер 2</li>
                                <li class="drop-list-item">Менеджер 3</li>
                                <li class="drop-list-item">Менеджер 4</li>
                                <li class="drop-list-item">Менеджер 5</li>
                                <li class="drop-list-item">Менеджер 6</li>
                                <li class="drop-list-item">Менеджер 7</li>
                                <li class="drop-list-item">Менеджер 8</li>
                                <li class="drop-list-item">Менеджер 9</li>
                                <li class="drop-list-item">Менеджер 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>--}}
                      </div>
                        <div  wire:key="script-prod" >
                      <div class="col-12">

    @if(isset($data['region_manager_id']) AND is_array($data['region_manager_id']) AND count($data['region_manager_id']) >0 )
    <div class="tagger">
    <ul>
        @foreach ($data['region_manager_id'] as $key_k=>$item_k)
        @if(is_array($item_k))
        <li>
        <a href="javascript: void(0);">
            <span class="label">{{$item_k['no_data']}}</span>
            <span href="#" class="close" onclick="@this.unSetDataTags('region_manager_id','{{$key_k}}')">×</span>
        </a>
        </li>
        @else
        <li>
        <a href="javascript: void(0);" class="--yellow">
            <span class="label">{{$item_k}}</span>
            <span href="#" class="close" onclick="@this.unSetDataTags('region_manager_id','{{$key_k}}')">×</span>
        </a>
        </li>
        @endif
        @endforeach

        <li class="tagger-new">
            <input class="js-tags-next" onkeypress="return addNewTags(event,'region_manager_id',this.value);" placeholder="@lang('custom::admin.region_managers')" >
            <div class="tagger-completion"></div>
        </li>
    </ul>
</div>
    @else
    <input class="js-tags-first form-control" onkeypress="return addNewTagsFirst(event,'region_manager_id',this.value);" type="text" placeholder="@lang('custom::admin.region_managers')" value = "">
    @endif
</div>
                      <div class="col-12 mt-3">

    @if(isset($data['selected_users']) AND is_array($data['selected_users']) AND count($data['selected_users']) >0 )
    <div class="tagger">
    <ul>
        @foreach ($data['selected_users'] as $key_k=>$item_k)
        @if(is_array($item_k))
        <li>
        <a href="javascript: void(0);">
            <span class="label">{{$item_k['no_data']}}</span>
            <span href="#" class="close" onclick="@this.unSetDataTags('selected_users','{{$key_k}}')">×</span>
        </a>
        </li>
        @else
        <li>
        <a href="javascript: void(0);" class="--yellow">
            <span class="label">{{$item_k}}</span>
            <span href="#" class="close" onclick="@this.unSetDataTags('selected_users','{{$key_k}}')">×</span>
        </a>
        </li>
        @endif
        @endforeach

        <li class="tagger-new">
            <input class="js-tags-next" onkeypress="return addNewTags(event,'selected_users',this.value,'legal');" placeholder="@lang('custom::admin.selected_users')" >
            <div class="tagger-completion"></div>
        </li>
    </ul>
</div>
    @else
    <input class="js-tags-first form-control" onkeypress="return addNewTagsFirst(event,'selected_users',this.value,'legal');" type="text" placeholder="@lang('custom::admin.selected_users')" value = "">
    @endif
  {{-- <div class="form-group mt-4"><button class="button" type="button">Добавить</button></div>--}}

</div>

                    </div>

                      <div class="col-12">
                        <div   wire:ignore.self >
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['parent_id']) ? $select_data['parent_id']: null),
                        'select_data_array'=>$parent_cp_select,
                        'placeholder'=>__('custom::admin.Parent counterparty'),
                        'drop_class'=> '--search',
                        'index'=>'parent_id',
                        'disabled_select'=>true,
                        'show_name'=>true
                        ])

                      </div>
                      </div>
                      <div class="col-12">
    @if(isset($data['parent_counterparties']) AND is_array($data['parent_counterparties']) AND count($data['parent_counterparties']) >0 )
    <div class="tagger">
    <ul>
        @foreach ($data['parent_counterparties'] as $key_k_c=>$item_k_c)
        @if(is_array($item_k_c))
        <li>
        <a href="javascript: void(0);">
            <span class="label">{{$item_k_c['no_data']}}</span>
            <span href="#" class="close" onclick="@this.unSetDataTags('parent_counterparties','{{$key_k_c}}')">×</span>
        </a>
        </li>
        @else
        <li>
        <a href="javascript: void(0);" class="--yellow">
            <span class="label">{{$item_k_c}}</span>
            <span href="#" class="close" onclick="@this.unSetDataTags('parent_counterparties','{{$key_k_c}}')">×</span>
        </a>
        </li>
        @endif
        @endforeach

        <li class="tagger-new">
            <input class="js-tags-next" onkeypress="return addNewTags(event,'parent_counterparties',this.value,'counterparty');" placeholder="@lang('custom::admin.selected_users')" >
            <div class="tagger-completion"></div>
        </li>
    </ul>
</div>
    @else
    <input class="js-tags-first form-control" onkeypress="return addNewTagsFirst(event,'parent_counterparties',this.value,'counterparty');" type="text" placeholder="@lang('custom::admin.selected_parent_counterparties')" value = "">
    @endif
  {{-- <div class="form-group mt-4"><button class="button" type="button">Добавить</button></div>--}}

                    </div>
                    </div>
                  </form>



<script>
    /* ---------------------------- Tags в поле input --------------------------- */


   function addNewTags(e,key_item, value, role = 'manager') {
     if(e.which == 13) {
        //alert('ddd');
        @this.setDataTags(key_item,value,role)
        $('.js-tags-next').val('');
    }
   }

   function addNewTagsFirst(e,key_item, value, role = 'manager') {
     if(e.which == 13) {
        @this.setDataTags(key_item,value,role)
        $('.js-tags-first').val('');
    }
   }


  </script>
                </div>
                <div class="col-xl-6">
                  <div class="partner-file">
                    <div class="partner-file__title">@lang('custom::admin.Statut')</div>
                    @php($index = 'ustav_file')
                    @if(isset($data[$index]) AND \Storage::disk('public')->exists($data[$index]) OR isset($data[$index]) AND is_object($data[$index]))

                    <div class="upload-unit --partners">
                    <div class="upload-unit__label">
                        <div class="upload-unit__info">
                        <div class="upload-unit__box">
                            <div>
                            <img src="/admin/assets/img/pdf.svg" alt="pdf">
                            </div>
                            <div>
                            <div class="upload-unit__title">{{ is_object($data[$index]) ? $data[$index]->getClientOriginalName() : basename(\Storage::disk('public')->url($data[$index]))}}</div>
                            <div class="upload-unit__date">{{ \Carbon\Carbon::now()->format('d.m.Y') }}</div>
                            </div>
                        </div>
                        <div class="upload-unit__trash"><i class="ico_close" onclick="@this.set('data.{{ $index }}','')"></i></div>
                        </div>
                    </div>
                    </div>

                    @else
                    <div class="upload-file-block --partners">
                      <div class="upload-file-block__box"></div>
                      <div class="upload-file-block__btn">
                        <label class="upload-file-block__label">
                            <input class="upload-file-block__input" type="file" name="upload-file" wire:model="data.{{ $index }}">
                          <div class="upload-file-block__label-content">
                            <span class="ico_upload"></span>
                            <span>@lang('custom::admin.Upload file')</span></div>
                        </label></div>
                    </div>


                    @endif
                  </div>
                  <div class="partner-file">
                    <div class="partner-file__title">@lang('custom::admin.Contract')</div>
                    @php($index = 'contruct_file')
                    @if(isset($data[$index]) AND \Storage::disk('public')->exists($data[$index]) OR isset($data[$index]) AND is_object($data[$index]))

                    <div class="upload-unit --partners">
                    <div class="upload-unit__label">
                        <div class="upload-unit__info">
                        <div class="upload-unit__box">
                            <div>
                            <img src="/admin/assets/img/pdf.svg" alt="pdf">
                            </div>
                            <div>
                            <div class="upload-unit__title">{{ is_object($data[$index]) ? $data[$index]->getClientOriginalName() : basename(\Storage::disk('public')->url($data[$index])) }}</div>
                            <div class="upload-unit__date">{{ \Carbon\Carbon::now()->format('d.m.Y') }}</div>
                            </div>
                        </div>
                        <div class="upload-unit__trash"><i class="ico_close" onclick="@this.set('data.{{ $index }}','')"></i></div>
                        </div>
                    </div>
                    </div>

                    @else
                    <div class="upload-file-block --partners">
                      <div class="upload-file-block__box"></div>
                      <div class="upload-file-block__btn">
                        <label class="upload-file-block__label">
                            <input class="upload-file-block__input" type="file" name="upload-file" wire:model="data.{{ $index }}">
                          <div class="upload-file-block__label-content">
                            <span class="ico_upload"></span>
                            <span>@lang('custom::admin.Upload file')</span></div>
                        </label></div>
                    </div>


                    @endif
                  </div>
                </div>
              </div>

            </div>
            <div class="tab-pane fade @if(isset($changeLangTabItem)  AND $changeLangTabItem==='person') active show @endif" role="tabpanel">
              <div class="col-xl-9">
                <div class="row g-3">
                  <div class="col-12">
                    <div class="person-box">
                      <div class="person-box__title">
                        <h5>@lang('custom::admin.Authorized person')</h5>
                        <div class="action-group" style="left: -10px">
                          <div class="action-group-btn"><span class="ico_submenu"></span></div>
                          <div class="action-group-drop">
                            <ul class="action-group-list">
                              <li><button class="js-show-person-box  ico_plus"  data-bs-target="#m-add-edit-founder" onclick="@this.addRemoveFounder('show')" data-bs-toggle="modal" type="button"></button></li>
                              <li>
                                @if(isset($data['founder']))
                                <button class="js-hide-person-box ico_trash"  onclick="@this.selectTab('info_user');@this.deleteFounderData({{isset($data['founder']['id']) ? $data['founder']['id'] : 0}});" type="button"></button>
                                @endif
                            </li>
                              <li>
                                <button class="js-hide-drop ico_close" onclick="" type="button"></button>
                            </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      @if(isset($data['founder']) AND count($data['founder'])>0)
                        @include('livewire.admin.counterparties.includes.founder.show-item-founder',['founder_data'=>$data['founder'],'key_item_f'=>'founder'])

                    @endif
                @include('livewire.admin.counterparties.includes.founder.popup-add-edit')

                    </div>
                  </div>
                  <div class="col-12">
                    <div class="person-box">
                      <div class="person-box__title">
                        <h5>@lang('custom::admin.User counterparty')</h5>
                        <div class="action-group" style="left: -10px">
                          <div class="action-group-btn"><span class="ico_submenu"></span></div>
                          <div class="action-group-drop">
                            <ul class="action-group-list">
                              <li><button class="js-show-person-box  ico_plus"  data-bs-target="#m-add-edit-founder-user" onclick="@this.addRemoveFounderUser('show')" data-bs-toggle="modal" type="button"></button></li>
                              <li>
                                @if(isset($selectedData) AND count($selectedData)>0)
                                <button class="js-hide-person-box ico_trash"  onclick="@this.addRemoveFounderUser('remove');" type="button"></button>
                                @endif
                            </li>
                              <li>
                                <button class="js-hide-drop ico_close" type="button"></button>
                            </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      @if(isset($data['founder_user']) AND count($data['founder_user'])>0)
                        @include('livewire.admin.counterparties.includes.founder-user.show-item-founder',['founder_data'=>$data['founder_user'],'key_item_f'=>'founder_user'])

                    @endif

                @include('livewire.admin.counterparties.includes.founder-user.popup-add-edit')

                  </div>
                </div>
              </div>
            </div>

            </div>
        <div class="tab-pane fade @if(isset($changeLangTabItem)  AND $changeLangTabItem==='contracts') active show @endif" role="tabpanel">
            <div class="row g-4">
            <div class="col-6" wire:ignore>
                @livewire('admin.contracts.contract-item-livewire', ['counterparty_id' => $item_id], key(time().'-'.$item_id))

            </div>
            </div>
        </div>
@if(isset($changeLangTabItem)  AND $changeLangTabItem!='contracts')
<div class="page-save mt-4">
    @include('livewire.admin.includes.save-data-include',['wire_click'=>"saveData",'title_button'=>__('custom::admin.Save')])
</div>
@endif

<script>
        function showMasc(item) {
            $(item).inputmask({"mask": "+38(999) 999-99-99"});

        }

</script>
