
<div class="table-before-btn --small">
    <div>
        <div class="action-group" >
            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li><a class="button button-accent button-small button-icon ico_plus" href="{{ route('admin.contucts.create')}}"></a></li>
                    @if(isset($selectedData) AND count($selectedData)>0)
                      <li><button class="ico_trash" type="button"  data-bs-target="#dellModeAll" data-bs-toggle="modal"></button></li>
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
                    <span>@lang('custom::admin.Subdivision')</span></div>
                </th>
                <th  class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.City')</th>
                <th  class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Filial')</th>
                <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Contuct')</th>

                {{--<th  class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Phone')</th>

                <th  class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.E-mail')</th>--}}
                <th  style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Activity')</th>
                <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Order')</th>
                <th class="text-end text-xl-center w-1 footable-last-visible"></th>
              </tr>
            </thead>
            <tbody>
                @php
                    $L=1;
                @endphp
            @if(isset($data_paginate) AND count($data_paginate)>0)
                @foreach ($data_paginate as $key=>$item)
                    @if(!isset($deleteTmpData[$item->id]))
                    @include('livewire.admin.contucts.includes.show-item-data')

                    @php
                        $L++;
                    @endphp
                    @endif
                @endforeach
            @endif

            @if(isset($addTmpData) AND count($addTmpData)>0)
                @foreach ($addTmpData as $key_p=>$item_tmp)
                    @if(!isset($deleteTmpData[$key_p]))
                @php
                    $item_p = $item_tmp['data'];
                    $parent_data = $item_tmp['data_parent'];
                @endphp
              <tr>
                <td style="display: table-cell;"  class="footable-first-visible">
                    <div class="box-brand">
                    <label class="check" >
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$key_p])) checked="checked" @endif onclick="@this.resetDataContucts(); @this.selectDataItem('{{ $key_p }}');"  />
                        <span class="check__box"></span></label>
                        <span>
                            @if(isset($item) AND isset($editTmpData[$item->id]['data'][session('lang')]['title']))
                            {{ $editTmpData[$item->id]['data'][session('lang')]['title'] }}
                            @else
                            {{ isset($item_p[session('lang')]['title']) ? $item_p[session('lang')]['title']: '' }}
                            @endif
                        </span>
                    </div>
                </td>
                <td class="text-md-center" style="display: table-cell;"><span>{{ isset($parent_data[session('lang')]['title']) ? $parent_data[session('lang')]['title'] : '' }}</span></td>
                {{--<td class="text-md-center" style="display: table-cell;"><span>{{ isset($parent_data[session('lang')]['posada']) ? $parent_data[session('lang')]['posada'] : '' }}</span></td>
                <td class="text-md-center" style="display: table-cell;">
                    @if(isset($parent_data['phones']) AND $arr_phones = json_decode($parent_data['phones'],true))
                    @foreach ($arr_phones as $key_ph=>$item_ph)
                        <span>{{$item_ph}}</span>
                        @if($key_ph+1 != count($arr_phones))
                        <br>@endif
                    @endforeach
                    @endif
                </td>
                <td class="text-md-center" style="display: table-cell;">
                    @if(isset($parent_data['emails']) AND $arr_emails = json_decode($parent_data['emails'],true))
                    @foreach ($arr_emails as $key_e=>$item_e)
                        <span>{{$item_e}}</span>
                        @if($key_e+1 != count($arr_emails))
                        <br>@endif
                    @endforeach
                    @endif
                </td>--}}

                <td class="text-md-center"  style="display: table-cell;">
                <label class="check eye"><input class="check__input" type="checkbox"  onclick="@this.changeStatusDataTmp({{ $key_p }},'status')" @if(isset($item['item_tmp']) AND $item_tmp['status'] == 0) checked="checked" @endif/><span class="check__box"></span></label>

                </td>
                <td class="text-end text-md-center footable-last-visible" style="display: table-cell;">
                    <button class="button button-small button-icon ico_edit" type="button" data-bs-target="#m-edit-subdivision" data-bs-toggle="modal" onclick="@this.setItemIdEdit('{{ $key_p }}')"></button>
                </td>
              </tr>

                    @php
                        $L++;
                    @endphp
                    @endif
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

<div wire:ignore>
<script>
    function changeOrderCustom(id_s, values, input){

        if(values == 0)
            {
                values = 1;
                input.value = values;
            }

            if(values>{{count($data_paginate)}})
            {
                values = {{count($data_paginate)}};
                input.value = values;
              //  alert(input.value);
            }
        @this.changeOrderCustom(id_s,values);

    }
</script>
</div>
