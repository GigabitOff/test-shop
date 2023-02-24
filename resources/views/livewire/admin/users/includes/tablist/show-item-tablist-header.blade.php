<div class="row g-3">
    <div class="col-xl-3 col-md-6">
        @include('livewire.admin.includes.select-data-arrow',[
            'select_data_input'=>(isset($select_data['filter']) ? $select_data['filter']: null),
            'select_data_array'=>$select_array['filter'],
            'placeholder'=>__('custom::admin.Filters'),'index'=>'filter','show_name'=>true])
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="drop ">
            <spacn class="drop-clear @if(isset($search_fio) AND $search_fio != '') _active @endif" onclick="@this.deleteDataSearch('search_fio')"></spacn>
            <input class="form-control drop-input" type="text" autocomplete="off" placeholder="@lang('custom::admin.clients.FIO')" wire:model.debounce.700ms="search_fio" />
            {{--<div class="drop-box">
                <div class="drop-overflow">
                    <ul class="drop-list">
                          <li class="drop-list-item">@lang('custom::admin.clients.FIO') 1</li>
                          <li class="drop-list-item">@lang('custom::admin.clients.FIO') 2</li>
                          <li class="drop-list-item">@lang('custom::admin.clients.FIO') 3</li>
                          <li class="drop-list-item">@lang('custom::admin.clients.FIO') 4</li>
                          <li class="drop-list-item">@lang('custom::admin.clients.FIO') 5</li>
                          <li class="drop-list-item">@lang('custom::admin.clients.FIO') 6</li>
                          <li class="drop-list-item">@lang('custom::admin.clients.FIO') 7</li>
                          <li class="drop-list-item">@lang('custom::admin.clients.FIO') 8</li>
                          <li class="drop-list-item">@lang('custom::admin.clients.FIO') 9</li>
                          <li class="drop-list-item">@lang('custom::admin.clients.FIO') 10</li>
                        </ul>
                </div>
            </div>--}}
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="drop">
            <spacn class="drop-clear @if(isset($select_edrpou) AND $select_edrpou != '') _active @endif" onclick="@this.deleteDataSearch('select_edrpou')"></spacn>
        <input class="form-control" type="text" placeholder="@lang('custom::admin.clients.EDRPOU')/@lang('custom::admin.clients.Name')" wire:model.debounce.700ms="select_edrpou">
        </div>
    </div>
    <div class="col-xl-3 col-md-6">

              <div class="drop --arrow @if(isset($search_roles))_selected @endif" wire:ignore.self>
                    <span class="drop-clear @if(isset($search_roles)) _active @endif" onclick="@this.deleteDataSearch('search_roles')"></span>

                <input class="form-control drop-input  drop-input-hide" type="text" autocomplete="off" placeholder="@lang('custom::admin.Roles')"  />
    <button class="form-control drop-button" type="button">@if(isset($search_roles)){{ __('custom::admin.role.'.$search_roles) }}@else{{ __('custom::admin.Roles') }}@endif</button>
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                        @foreach ($select_roles as $key_rol => $item_rol)
                        @if($item_rol->name != 'api_manager')
                      <li class="drop-list-item" onclick="@this.set('search_roles','{{ $item_rol->name }}')">{{ __('custom::admin.role.'.$item_rol->name) }}</li>
                        @endif
                        @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
    <div class="col-xl-3 col-md-6">
         <div class="drop">
            <spacn class="drop-clear @if(isset($select_ip) AND $select_ip != '') _active @endif" onclick="@this.deleteDataSearch('select_ip')"></spacn>
        <input class="form-control" type="text" placeholder="@lang('custom::admin.IP')" wire:model.debounce.700ms="select_ip">
        </div>
    </div>

            <div class="col-xl-3 col-md-6">
        <div class="js-date-group input-group">
            <input id="search_date_start"  type="text" class="js-date form-control" value="{{isset($search_date_start) ? $search_date_start : ''}}" placeholder="@lang('custom::admin.From')" />

        @include('livewire.admin.includes.calendar-form',['formId'=>'search_date_start','nameForm'=>'search_date_start','date_start'=>'search_date_start','single'=>'single','clear'=>true, 'maxDate'=>'now'])
        <input type="hidden" wire:model="search_date_start">

        <input id="search_date_end"  type="text" class="js-date form-control" value="{{isset($search_date_end) ? $search_date_end : ''}}" placeholder="@lang('custom::admin.To')" />
          @if(isset($search_date_end) OR isset($search_date_start))
        <button class="js-clear-date clear-date" type="button" onclick="@this.set('search_date_end',null); @this.set('search_date_start',null)"></button>

        @endif
        @include('livewire.admin.includes.calendar-form',['formId'=>'search_date_end','nameForm'=>'search_date_end','date_start'=>'search_date_end','single'=>'single','clear'=>true, 'maxDate'=>'now'])
        <input type="hidden" wire:model="search_date_end">

            </div>
            </div>
            <div class="col-xl-6 col-md-6">
              <div class="drop --search">
                <span class="drop-clear @if(isset($search) AND $search != '') _active @endif" onclick="@this.deleteDataSearch('search')"></span>
                <input class="form-control drop-input" type="text" autocomplete="off" placeholder="@lang('custom::admin.Search')" wire:model.debounce.700ms= "search" />
                {{--<div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Результат поиска 1</li>
                      <li class="drop-list-item">Результат поиска 2</li>
                      <li class="drop-list-item">Результат поиска 3</li>
                      <li class="drop-list-item">Результат поиска 4</li>
                      <li class="drop-list-item">Результат поиска 5</li>
                      <li class="drop-list-item">Результат поиска 6</li>
                      <li class="drop-list-item">Результат поиска 7</li>
                      <li class="drop-list-item">Результат поиска 8</li>
                      <li class="drop-list-item">Результат поиска 9</li>
                      <li class="drop-list-item">Результат поиска 10</li>
                    </ul>
                  </div>
                </div>--}}
              </div>
            </div>
</div>
