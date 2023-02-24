<div class="table-before-btn --small">
    <div>
        <div class="action-group" >
            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li><button class="button button-accent button-small button-icon ico_plus" onclick="@this.createDataItem()"></button></li>
                    @if(isset($selectedData) AND count($selectedData)>0)
                      <li><button class="ico_trash" type="button"  onclick="@this.dellAllDataTmp()"></button></li>
                    @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
            </div>
    </div>
</div>
    <table class="js-table js-table_new footable" >
            <thead>
              <tr class="footable-header">
                <th style="display: table-cell;" class="footable-first-visible">
                    <div class="d-flex align-items-center">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" />
                        <span class="check__box"></span>
                    </label>
                    <span>@lang('custom::admin.Contract number')</span></div>
                </th>
                <th  class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Name of the contract')</th>

                <th  style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Status')</th>
                <th class="text-end text-xl-center w-1 footable-last-visible"></th>
              </tr>
            </thead>
            <tbody>
                @php
                    $L=1;
                @endphp
            @if(isset($data_paginate) AND count($data_paginate)>0)
                @foreach ($data_paginate as $key=>$item)
                    <tr>
                <td style="display: table-cell;"  class="footable-first-visible">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')"  />
                        <span class="check__box"></span></label>
                        <span>{{ isset($item['registry_no']) ? $item['registry_no'] : '' }}</span>
                </td>
                <td class="text-md-center" style="display: table-cell;"><span>{{ isset($item['name']) ? $item['name'] : '' }}</span></td>
                <td class="text-md-center" style="display: table-cell;"><span>{{ isset($item['status']) ? __('custom::admin.status_counterparty.'.$item['status']) : '' }}</span></td>

                <td class="text-end text-md-center footable-last-visible" style="display: table-cell;">
                    <button class="button button-small button-icon ico_edit" type="button" onclick="@this.editDataItem({{ $item['id'] }})"></button>
                </td>
              </tr>
                    @php
                        $L++;
                    @endphp
                @endforeach
            @endif



             @if($L == 1)
        <tr>
                <td class="text-center" style="display: table-cell;" colspan="5">
                    @lang('custom::admin.No data available')
                </td>
            </tr>
    @endif
            </tbody>
          </table>
          @if(isset($data_paginate) AND count($data_paginate)>0)

          @foreach ($data_paginate as $key=>$item)
            @if($item->slug != 'main')
              @include('livewire.admin.includes.scripts_data',['on_click'=>'destroyData('.$item->id.')','key'=>$item->id, 'title'=>'Сторінку: '.$item->title])
            @endif
            @endforeach
        @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllDataTmp()','key'=>'All', 'title'=>''])

            @endif

