<div class="table-before-btn --small">
              <div>
                <div class="action-group">
                  <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li><a class="button button-accent button-small button-icon ico_plus" href="{{route('admin.vacancies.create')}}"></a></li>
                    @if(isset($selectedData) AND count($selectedData)>0)
                      <li><button class="ico_trash" type="button"  data-bs-target="#dellModeAll" data-bs-toggle="modal"></button></li>
                    @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
<table class="js-table js-table_new footable" data-paging-size="4">
    <thead>
        <tr class="footable-header">
            <th style="display: table-cell;" class="footable-first-visible">
                <div class="d-flex align-items-center">
                    <label class="check js-select-all">
                          <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" />
                          <span class="check__box"></span></label>
                @lang('custom::admin.Name job')
                </div>
            </th>
            <th class="text-md-center" style="display: table-cell;">@lang('custom::admin.Date publisher')</th>
            <th class="text-md-center" style="display: table-cell;">@lang('custom::admin.Activity')</th>
            <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Order')</th>
            <th class="text-end text-md-center w-1 footable-last-visible"" style="display: table-cell;">

            </th>
        </tr>
    </thead>
    <tbody>

        @if(isset($data_paginate) AND count($data_paginate)>0)
        @foreach ($data_paginate as $key=>$item)
        <tr>
            <td style="display: table-cell;" class="footable-first-visible">
                <div class="box-services">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')" ><span class="check__box"></span>
                    </label>
                    <span class="accent">{{ $item->id }}</span>
                    <a href="{{ route('admin.vacancies.edit',$item->id)}}">@if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif</a>
                </div>
            </td>
            <td class="text-md-center" style="display: table-cell;"><span>{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}</span></td>
            <td class="text-md-center" style="display: table-cell;">
                <label class="check eye"><input class="check__input" type="checkbox"  onclick="@this.changeStatusData({{$item->id}},'status')" @if($item->status == 0) checked="checked" @endif/><span class="check__box"></span></label>
            </td>
            <td class="text-md-center" style="display: table-cell;">
                    <input class="form-control form-xs" type="number"  value="{{ $item->order }}" onchange="changeOrderCustom({{$item->id}}, this.value,this)">
                </td>
            <td class="text-end w-1 footable-last-visible"" style="display: table-cell;">
                <a class="button button-small button-icon ico_edit" {{-- @if($target) target="_blank" @endif --}} href="{{ route('admin.vacancies.edit',$item->id)}}"></a>
            </td>
        </tr>
            @endforeach
        @else
        <tr>
                <td class="text-center" style="display: table-cell;" colspan="5">
                    @lang('custom::admin.No data available')
                </td>
            </tr>


@endif
    </tbody>
</table>

    <div>
        @if(isset($data_paginate) AND count($data_paginate)>0)

          @foreach ($data_paginate as $key=>$item_del)

              @include('livewire.admin.includes.scripts_data',['wire_click'=>'destroyData('.$item_del->id.')','key'=>$item_del->id, 'title'=>''.$item_del->name])

            @endforeach
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
    @endif
    </div>
        @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])

