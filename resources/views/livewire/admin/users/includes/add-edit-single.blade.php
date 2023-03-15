<div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
@if(isset($data['id']))
<h4 class="text-center text-lg-start">ID {{ $data['id'] }}</h4>
@endif
<div class="row g-4">
    <div class="col-xl-6">
        <form action="#!">
            <div class="row g-3">
                @php
                    $customer_types = App\Models\User::CUSTOMER_TYPES;

                    if(isset($data['customer_type']))
                    {
                    $user_customer_type = __('custom::admin.customer_types.'.$customer_types[$data['customer_type']]);

                    }else{
                    $user_customer_type = isset($data_collect->customer_type) ? __('custom::admin.customer_types.'.$data_collect->customer_type->key) : '';

                    }
                @endphp

                <div class="col-12"  wire:ignore.self>
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
                <div class="col-12">
                    <input class="form-control @error('data.'.session('lang').'.name') is-invalid @enderror" type="text"
                    placeholder="@lang('custom::admin.clients.FIO')"
                    wire:model="data.{{session('lang')}}.name">
                    @error('data.'.session('lang').'.name')
                    <div class="is-invalid ">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-12">

                    <input class="js-phone form-control @error('data.phone') is-invalid @enderror"
                    type="text"
                    autocomplete="off"
                    placeholder="@lang('custom::admin.clients.Phone')" onchange="@this.set('phone',this.value); @this.validateDataUser();" @if(isset($data['phone'])) value="{{ mb_substr($data['phone'],2,12) }}" @else value="{{$phone}}" @endif>
                    @error('data.phone')
                    <div class="valid-feedback show ">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-12 _pass-form user-password">
                        <div class="form-group mb-3">
                            <input class="js-password _pass _pass-1 form-control @error('data.password') is-invalid @enderror" name="password-1" placeholder="@lang('custom::admin.Password')" autocomplete="off"
                    @if(!$show_pass)type="password" @else type="text" @endif wire:model.lazy="data.password" required="">
                          <div class="show-password" @if(!$show_pass)onclick="@this.set('show_pass',true);" @else onclick="@this.set('show_pass',null);" @endif ></div>
                        </div>
                        <div class="form-group  mb-3">
                            <input class="js-password form-control _pass-2 @if(isset($data['password']) AND $data['password'] != '' AND !isset($data['password_confirmation']) OR isset($data['password']) AND $data['password'] != '' AND $data['password'] != $data['password_confirmation']) is-invalid @endif" type="password" name="password-2" placeholder="@lang('custom::admin.clients.Confirm Password')" required="" wire:model.lazy="data.password_confirmation">
                          @if(isset($data['password']) AND $data['password'] != '' AND !isset($data['password_confirmation']) OR isset($data['password']) AND $data['password'] != '' AND $data['password'] != $data['password_confirmation'])
                          <div class="invalid-feedback">@lang('custom::admin.messages.Passwords do not match')</div>
                        @endif
                        </div>
                        <div wire:ignore class="password-quality">
                          <div class="_password-quality-title password-quality__title">@lang('custom::admin.messages.Password strength')</div>
                          <ul class="_password-quality password-quality__list">
                            <li class="one"></li>
                            <li class="two"></li>
                            <li class="three"></li>
                            <li class="four"></li>
                            <li class="five"></li>
                          </ul>
                        </div>
                        @error('data.password')
                    <div class="is-invalid ">
                        {{$message}}
                    </div>
                    @enderror
                      </div>
                <div class="col-12">
                    <input class="form-control @error('data.email') is-invalid @enderror" type="text"
                    placeholder="@lang('custom::admin.clients.Email')"
                    wire:model="data.email">
                    @error('data.email')
                    <div class="is-invalid ">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-12" >
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
@if(isset($this->data['user_role']) AND $this->data['user_role'] != 'simple' AND $this->data['user_role'] != 'unregistered')
                 <div class="col-12 show-hide">
                    <label class="check ">
                    <input class="check__input" type="checkbox" @if(isset($counterparties_data_user) AND count($counterparties_data_user)>0 OR isset($data['counterparty_id']) AND $data['counterparty_id'] !==null) checked  onclick="@this.deleteDataList('null','','counterparty_id')" @else onclick = "@this.startAddCounterpaties()" @endif />
                    <span class="check__box">@lang('custom::admin.Associated with a counterparty')</span></label>
                </div>

            <div  @if(isset($counterparties_data_user) AND count($counterparties_data_user)>0 OR isset($data['counterparty_id']) AND $data['counterparty_id'] !==null) @else style="display: none;" @endif >
                <div class="col-12 mb-3">

                <div class="show-hide-box" >
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['counterparty_id']) ? $select_data['counterparty_id']: null),
                        'select_data_array'=>$counterparties_select, 'placeholder'=>__('custom::admin.Main counterparty'),
                        'index'=>'counterparty_id',
                        'show_name'=>true
                        ])
                </div>
                </div>
            <div  class="col-12">

    @if(isset($data['counterpaties_name']) AND $data['counterpaties_name'] != '')
    <div class="tagger">
    <input class="form-control" type="hidden" placeholder="@lang('custom::admin.Add hashtag')" value="sdfsdf,dfsdfsdf" hidden="hidden">
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
                @endif
               {{-- <div class="col-12 page-save"><button class="button" type="button">Добавить контрагента</button></div>--}}
                <div class="col-12">
                    <label class="check" onclick="@this.changeDataItem('is_admin','{{(isset($data['is_admin']) AND $data['is_admin']==1) ? 0 : 1}}')">
                        <input class="check__input" type="checkbox" @if(isset($data['is_admin']) AND $data['is_admin']==1) checked @endif  wire:ignore.self />
                        <span class="check__box">@lang('custom::admin.Admin group')</span>
                    </label>
                </div>
                @if(isset($this->data['user_role']) AND $this->data['user_role'] != 'manager'  AND $this->data['user_role'] != 'head_manager')
                <div class="col-12">
                    <label class="check"><input class="check__input" type="checkbox" /><span class="check__box">@lang('custom::admin.Subscribed to newsletter')</span></label>
                </div>
                @endif
                @if(isset($item_id))

                <div class="col-12">
                    @if(isset($this->data['user_role']) AND $this->data['user_role'] == 'manager' OR isset($this->data['user_role']) AND $this->data['user_role'] == 'head_manager')
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['manager_id']) ? $select_data['manager_id']: null),
                        'select_data_array'=>(isset($select_array['manager_id']) ? $select_array['manager_id'] : null),
                        'placeholder'=>__('custom::admin.Senior manager'),
                        'index'=>'manager_id',
                        'show_name'=>true
                        ])
                    @else

                        @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['manager_id']) ? $select_data['manager_id']: null),
                        'select_data_array'=>(isset($select_array['manager_id']) ? $select_array['manager_id'] : null),
                        'placeholder'=>__('custom::admin.Manager'),
                        'index'=>'manager_id',
                        'show_name'=>true
                        ])


                    @endif
                </div>
                @if(isset($dataItem->manager->manager_id) ANd isset($select_data['manager_id']))
                    @if(isset($this->data['user_role']) AND $this->data['user_role'] != 'manager'  AND $this->data['user_role'] != 'head_manager' AND $this->data['user_role'] != 'admin' AND $this->data['user_role'] != 'director')
                    @if($dataItem->manager->manager)
                <div class="col-12">
                    <input class="form-control " disabled type="text" autocomplete="off" value="{{  $dataItem->manager->manager->name  }}" placeholder="@lang('custom::admin.Senior manager')" />
                </div>
                @endif
                @endif
                @endif
                <div class="col-12">
                    <div   wire:ignore.self class="show-hide-box" >
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['change_manager']) ? $select_data['change_manager']: null),
                        'select_data_array'=>$change_manager_select, 'placeholder'=>__('custom::admin.Transfer rights (ID or full name of the manager)'),
                        'index'=>'change_manager',
                        'show_name'=>true
                        ])

                </div>
                      </div>
                      <div class="col-12" @if(!isset($select_data['change_manager'])) style="display:none"@endif>
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($data['change_manager_all']) AND $data['change_manager_all']==1) checked @endif onclick="@this.changeDataItem('change_manager_all','{{(isset($data['change_manager_all']) AND $data['change_manager_all']==1) ? 0 : 1}}')" />
                        <span class="check__box">@lang('custom::admin.Transfer rights all')</span>
                    </label>
                </div>
                      <div class="col-7" @if(!isset($select_data['change_manager'])) style="display:none"@endif >
                        <input id="data_date_start_end" @error("data.date_to") style='border: 1px solid red' @enderror type="text" class="js-date form-control" value="{{ isset($data['date_from']) ? $data['date_from'] : \Carbon\Carbon::now()->format('d.m.Y')}} - {{ isset($data['date_to']) ? $data['date_to'] : ''}}" />
        @include('livewire.admin.includes.calendar-form',['formId'=>'data_date_start_end','nameForm'=>'data.date_start_end','date_start'=>'data.date_from','date_end'=>'data.date_to','clear'=>false])
        <input type="hidden" wire:model="data.date_from">
        <input type="hidden" wire:model="data.date_to">
                    </div>
                    @endif
                    @if(isset($data['phone_verified_at']))
                <div>
                <ul class="list-info mb-0">
                    <li>
                        <span>@lang('custom::admin.Number confirmed')</span>

                        <strong>
                            {{ \Carbon\Carbon::parse($data['phone_verified_at'])->format('d.m.Y') }}
                        </strong>
                    </li>
                </ul>
            </div>
                @endif


                    @if($data_collect AND $data_collect->phone_verified_at !== null)
                <div>
                  <ul class="list-info mb-0">
                    <li><span>@lang('custom::admin.Phone verificated')</span>
                        <strong>
                        {{ \Carbon\Carbon::parse($data_collect->phone_verified_at)->format('d.m.Y') }}
                        </strong>
                    </li>
                  </ul>
                  </div>
                  @endif
                </div>

              </form>

            </div>
            <div class="col-xl-6"  wire:ignore>
                @if($data_collect)
              @livewire('admin.users.user-blocked-livewire',['data_collect'=>$data_collect,'phone'=>isset($phone) ? $phone : null],
                    key(time().'user-blocked-livewire'))
                @endif
            </div>
            <div class="page-save col-12">
        @include('livewire.admin.includes.save-data-include',['on_click'=>'saveData()','title_button'=>__('custom::admin.Save')])

                </div>
          </div>

