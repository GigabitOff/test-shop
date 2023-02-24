
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
                    <tr>
                <td style="display: table-cell;"  class="footable-first-visible">
                    <div class="box-brand">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.resetDataContucts(); @this.selectDataItem('{{ $item->id }}')"  />
                        <span class="check__box"></span></label>
                        <span>
                            @if(isset($editTmpData[$item->id]['data'][session('lang')]['title']))

                        {{ $editTmpData[$item->id]['data'][session('lang')]['title'] }}
                        @else
                         @if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif
                            @endif
                        </span>
                    </div>
                </td>
                <td class="text-md-center" style="display: table-cell;">
                    <span>

                        {{ isset($item->shop->getCity) ? $item->shop->getCity->title : '' }}
                    </span>
                </td>
                <td class="text-md-center" style="display: table-cell;">
                    <span>

                        {{ isset($item->shop) ? $item->shop->title : ''}}
                    </span>
                </td>
                <td class="text-md-center" style="display: table-cell;">
                    <span>

                        {{ $item->name }}
                    </span>
                </td>

                <td class="text-md-center"  style="display: table-cell;">
                <label class="check eye"><input class="check__input" type="checkbox"  onclick="@this.changeStatusData({{$item->id}},'status')" @if($item->status == 0) checked="checked" @endif/><span class="check__box"></span></label>

                </td>
                <td class="text-md-center" style="display: table-cell;">
                    <input class="form-control form-xs" type="number"  value="{{ $item->order }}" onchange="changeOrderCustom({{$item->id}}, this.value, this)">
                </td>
                <td class="text-end text-md-center footable-last-visible" style="display: table-cell;">
                    <a class="button button-small button-icon ico_edit" href="{{ route('admin.contucts.edit', $item->id)}}"></a>
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
        @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])

            @endif

    @include('livewire.admin.includes.per-page-table')

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
