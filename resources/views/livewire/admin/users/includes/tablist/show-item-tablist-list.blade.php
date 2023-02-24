@include('livewire.admin.users.includes.tablist.show-item-tablist-header')
<div class="mt-4">
<div class="table-before-btn --small">
              <div>
                <div class="action-group" style="margin-right: -4px;">
                  <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li><a class="button button-accent button-small button-icon ico_plus" href="{{route('admin.users.create')}}"></a></li>

                        @if(isset($selectedData) AND count($selectedData)>0)
                      <li><button class="ico_trash" type="button"  data-bs-target="#dellModeAll" data-bs-toggle="modal"></button></li>
                      @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
    <table class="js-table js-table_new for_footable users-table table-td-small footable">
        <thead>
            <tr>
                <th class="text-xl-center w-1" style="display: table-cell;">
                  <div class="d-flex align-items-center">
                      <label class="check js-select-all">
                          <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" />
                          <span class="check__box"></span></label>
                          <span>ID</span>
                    </div>
                </th>
                <th style="display: table-cell;">
                    @lang('custom::admin.clients.FIO')<br>@lang('custom::admin.clients.Registration')
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Phone')<br>@lang('custom::admin.clients.E-mail')
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Counterparty')<br>@lang('custom::admin.clients.EDRPOU')
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Manager')
                </th>
                <th data-breakpoints="xs sm md">
                    @lang('custom::admin.clients.Role')
                </th>
                <th class="text-xl-center" data-breakpoints="xs sm md">
                    @lang('custom::admin.clients.Date of last entry')
                </th>
                <th class="text-xl-center" data-breakpoints="xs sm md">
                    @lang('custom::admin.Status')
                </th>
                <th class="text-end text-xl-center" data-breakpoints="xs sm md">

                </th>
            </tr>
        </thead>
        <tbody>
@if($data_paginate AND count($data_paginate)>0)
            @foreach ($data_paginate as $key=>$item)

            <tr>
                <td class="text-xl-center w-1 " style="display: table-cell;">
                    <div class="d-flex align-items-center" @if($item->deleted_at) style="color: #AAA;" @endif>
                        <label class="check">
                        <input class="check__input" @if($item->deleted_at) disabled @endif type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')" ><span class="check__box"></span>
                    </label>
                        <a class="accent nowrap" href="{{ $link = route('admin.users.edit', [$item->id]) }}">{{ $item->id }}</a></div>
                  </td>
                <td  class="footable-last-visible" style="display: table-cell;" >
                    <span class="d-block" @if($item->deleted_at) style="color: #AAA;" @endif>
                    {{ isset($item->name) ? $item->name: '' }}
                    {{--@if($item->getParent)
                        : {{$item->getParent->title}}
                    @endif--}}
                    </span>
                    <span class="d-block" @if($item->deleted_at) style="color: #AAA;" @endif>{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y')}}</span>
                </td>
                <td  style="display: table-cell;">
                    <span class="d-block" @if($item->deleted_at) style="color: #AAA;" @endif>{{ $item->phone }}</span>
                    <span class="d-block nowrap" @if($item->deleted_at) style="color: #AAA;" @endif>{{ $item->email }}</span>
                </td>
                <td style="display: table-cell;">
                    <span class="d-block" @if($item->deleted_at) style="color: #AAA;" @endif>
                        {{ ($item->counterparty !== null) ? $item->counterparty->name : ''}}
                    </span>
                    <span class="d-block" @if($item->deleted_at) style="color: #AAA;" @endif>{{ ($item->counterparty !== null) ? $item->counterparty->okpo : ''}}</span>
                </td>
                <td style="display: table-cell;">
                    <span class="nowrap" @if($item->deleted_at) style="color: #AAA;" @endif>{{ ($item->IsHasManager) ? $item->manager->name : ''}}</span>
                </td>
                <td class="text-xl-center" style="display: table-cell;">
                    <span @if($item->deleted_at) style="color: #AAA;" @endif>

                        @if(count($item->getRoleNames())>0)
                        @foreach ($item->getRoleNames() as $key_role => $role)
                        @if($key_role>0),@endif<span>{{ __('custom::admin.role.'. $role) }}</span>

                        @endforeach
                        @endif
                    </span>
                </td>
                <td class="text-xl-center" style="display: table-cell;">
                    <span  @if($item->deleted_at) style="color: #AAA;" @endif>
                        @if($item->entrances !== null AND count($item->entrances)>0)
                    {{ \Carbon\Carbon::parse($item->entrances[0]->login_at)->format('d.m.Y') }}</span>
                        @endif
                </td>
                <td class="text-xl-center" style="display: table-cell;">
                    <span @if($item->deleted_at) disabled @endif class="icon-status ico_checkmark mt-1 @if($item->is_active == 1 AND !$item->deleted_at) is-active @endif" onclick="@this.removeUser({{$item->id}})"></span>
                </td>
                <td class="text-end text-xl-center" style="display: table-cell;">
                    <a class="button button-small button-icon ico_edit" href="{{ $link}}"></a>
                </td>
            </tr>

            @endforeach
            @else
                <tr>
                    <td class="text-center" style="display: table-cell;" colspan="9">
                @lang('custom::admin.No data available')

                    </td>

                </tr>
    @endif
        </tbody>
    </table>

@if($data_paginate)
    <div>
        @if(isset($data_paginate) AND count($data_paginate)>0)

          @foreach ($data_paginate as $key=>$item_del)

              @include('livewire.admin.includes.scripts_data',['wire_click'=>'destroyData('.$item_del->id.')','key'=>$item_del->id, 'title'=>''.$item_del->name])

            @endforeach
          @include('livewire.admin.includes.per-page-table')
            @endif
    </div>
        @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])

    @endif

</div>
