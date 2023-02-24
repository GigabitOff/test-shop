<div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>

          <div  class="row g-4 mb-4">
            <div class="col-lg-6 col-12">
                <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror @error('slug') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Name')" wire:model.lazy="data.{{ session('lang')}}.title">
                @include('livewire.admin.includes.error-title')

            </div>
            <div class="col-lg-3 col-md-6">
                <input id="data_date_start_end" @error("data.date_start_end") style='border: 1px solid red' @enderror type="text" class="js-date-multy form-control" value="{{ isset($data['date_start']) ? $data['date_start'].' - ' : ''}}{{ isset($data['date_end']) ? $data['date_end'] : ''}}" />
        @include('livewire.admin.includes.calendar-form',['formId'=>'data_date_start_end','nameForm'=>'data.date_start_end','date_start'=>'data.date_start','date_end'=>'data.date_end','clear'=>false])
        <input type="hidden" wire:model="data.date_start">
        <input type="hidden" wire:model="data.date_end">
            </div>
        </div>
          <div class="row g-4"  @if($hideGroupUser !== null)style="display: none" @endif>

            {{--<div class="col-lg-3 col-md-6">
                <input id="data_date_end" @error("data.date_end") style='border: 1px solid red' @enderror type="text" class="js-date form-control" value="{{ isset($data['date_end']) ? $data['date_end'] : ''}}" placeholder="@lang('custom::admin.Date end')" />
        @include('livewire.admin.includes.calendar-form',['formId'=>'data_date_end','nameForm'=>'data.date_end','date_end'=>'data.date_end','clear'=>true, 'single'=>true,'minDate'=>( isset($data['date_start']) ? $data['date_start'] : ''),'from_date'=>( isset($data['date_start']) ? $data['date_start'] : '')])
        <input type="hidden" wire:model="data.date_end">
            </div>--}}

            <div class="col-12 mb-4">
               <div >
                <div class="drop --select @if(isset($data['role']))_selected @endif">{{--<span class="drop-clear"></span>--}}
                    <input class="form-control drop-input @error('data.role') is-invalid @enderror drop-input-hide" type="text" autocomplete="off" value="{{ isset($data['role']) AND $data['role'] !== null ? __('custom::admin.roles.'.$data['role']) : '' }}" placeholder="@lang('custom::admin.User role')" />
                    <button class="form-control drop-button" type="button">{{ isset($data['role']) ? __('custom::admin.role.'.$data['role']) : __('custom::admin.Users group') }}</button>

                    <div class="drop-box">
                      <div class="drop-overflow">
                        <ul class="drop-list">
                            <li class="drop-list-item" onclick="@this.setUserRole(null);">{{ __('custom::admin.Select') }}</li>
                           @foreach ($roles_select as $item_role)
                            @if($item_role->name != 'api_manager')
                          <li class="drop-list-item" onclick="@this.setUserRole('{{$item_role->name}}');">{{ __('custom::admin.role.'.$item_role->name) }}</li>
                            @endif
                            @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>

                </div>

            </div>

            </div>


        <div class="row mb-2" @if(isset($data['role']) AND $data['role'] !== null)style="display: none" @endif>
            <div class="col-12" wire:ignore >
                @livewire('admin.bonus.discount.bonus-discount-search-user-livewire', ['item_id'=>$item_id,'action_data'=>(isset($dataPage) ? $dataPage : null )], key(time().'-bonus-discount-search-user'))
            </div>
        </div>

        <div class="row  mb-2" @if($hideCategory !== null)style="display: none" @endif>
            <div class="col-12" wire:ignore>
                @livewire('admin.bonus.discount.bonus-discount-search-category-livewire', ['item_id'=>$item_id,'action_data'=>(isset($dataPage) ? $dataPage : null )], key(time().'-bonus-discount-search-category'))
            </div>
        </div>

        <div class="row  mb-2" @if($hideProd !== null)style="display: none" @endif>
            <div class="col-12">

                <div wire:ignore>

                    @livewire('admin.bonus.discount.bonus-discount-search-product-livewire', ['item_id'=>$item_id,'action_data'=>(isset($dataPage) ? $dataPage : null )], key(time().'-bonus-discount-search-product'))
                </div>

            </div>

        </div>
          <div class="row">
            <div class="col-1">
                  <div class="form-group">

                        <input class="form-control @error("data.percent")is-invalid @enderror " value="{{ isset($data['percent']) ?  $data['percent'] : 0}}" type="integer" placeholder="@lang('custom::admin.Procent discount')" onchange="@this.set('data.percent',this.value)">




                </div>

              </div>
            <div class="col pt-2 ml-0" style="margin-left: -5px; margin-top: 5px">%</div>

          </div>
          <div class="row">
            <div class="col-xl-3">
              <div class="form-group">
                <label class="check eye">
                    <input class="check__input" type="checkbox" wire:model="data.status" @if(!isset($data['status']) OR $data['status'] == 0)  checked="checked" @endif onclick="@this.set('data.status',{{ (!isset($data['status']) OR $data['status'] == 0) ? 1 : 0 }});"><span class="check__box"></span></label><span class="ms-2">@lang('custom::admin.Activity')</span></div>

            </div>
          </div>
          <div class="page-save text-end text-xl-start">
                @include('livewire.admin.includes.save-data-include',['on_click'=>"saveData();",'title_button'=>__('custom::admin.Save')])
              </div>

