@include('livewire.admin.counterparties.includes.tablist.show-item-tablist-header')
<div class="mt-4">

<div class="table-before-btn --small" >
              <div>
                <div class="action-group" style="margin-right:12px">
                  <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li><a class="button button-accent button-small button-icon ico_plus" href="{{route('admin.counterparties.create')}}"></a></li>

                        @if(isset($selectedData) AND count($selectedData)>0)
                      <li><button class="ico_trash" type="button"  data-bs-target="#dellModeAll" data-bs-toggle="modal"></button></li>
                      @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

    <table class="js-table_new js-table partners-table footable footable-1 footable-paging footable-paging-right breakpoint-lg">
        <thead>
            <tr class="footable-header">
                <th class="text-xl-center footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center">
                      <label class="check js-select-all">
                          <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" />
                          <span class="check__box"></span></label>
                          <span>ID</span>
                    </div>
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Form')
                </th>
                <th style="display: table-cell;">
                    @lang('custom::admin.clients.Company')<br>@lang('custom::admin.clients.Registration')
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">Ответственное лицо</th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Phone')
                </th>
                <th data-breakpoints="xs sm md" style="display: table-cell;">
                    @lang('custom::admin.clients.EDRPOU')
                </th>
                <th style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Activity')</th>

                <th class="text-end text-xl-center footable-last-visible"  style="display: table-cell;" data-breakpoints="xs sm md">

                </th>
            </tr>
        </thead>
        <tbody>
@if($data_paginate AND count($data_paginate)>0)
            @foreach ($data_paginate as $key=>$item)

            <tr >
                <td class="text-xl-center footable-first-visible" style="display: table-cell; @if($item->deleted_at) color: #AAA; @endif">
                    <div class="d-flex align-items-center" @if($item->deleted_at) style="color: #AAA;" @endif>
                        <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')" ><span class="check__box"></span>
                    </label>
                        <a class="accent nowrap" href="{{ $link = route('admin.counterparties.edit', [$item->id]) }}">{{ $item->id }}</a></div>
                  </td>
                <td  class="footable-last-visible" style="display: table-cell; @if($item->deleted_at) color: #AAA; @endif" >

                    {{ $item->form !== null ? $item->form : ''}}
                </td>
                <td style="display: table-cell; @if($item->deleted_at) color: #AAA; @endif">
                    <span class="d-block" >
                        {{ ($item->name !== null) ? $item->name : ''}}
                    </span>

                    <span class="d-block">{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}</span>
                </td>
                <td style="display: table-cell; @if($item->deleted_at) color: #AAA; @endif">
                        {{ ($item->founderCounterparty !== null) ? $item->founderCounterparty->name : ''}}

                </td>
                <td style="display: table-cell; @if($item->deleted_at) color: #AAA; @endif">
                    <span class="nowrap" >{{ ($item->phone) ? $item->phone : ''}}</span>

                </td>
                <td style="display: table-cell; @if($item->deleted_at) color: #AAA; @endif">
                    {{ ($item->okpo !== null) ? $item->okpo : ''}}

                </td>
                <td class="text-xl-center" style="display: table-cell;">
                    <span @if($item->deleted_at) disabled @endif class="icon-status ico_checkmark mt-1 @if(!$item->deleted_at) is-active @endif" onclick="@this.removeItemData({{$item->id}})"></span>
                </td>
                <td class="text-end text-xl-center footable-last-visible" style="display: table-cell;">
                    <a class="button button-small button-icon ico_edit" href="{{ $link}}"></a>
                </td>
            </tr>

            @endforeach
            @else
                <tr>
                    <td class="text-center" style="display: table-cell;" colspan="7">
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
