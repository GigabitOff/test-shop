
<div class="table-before-btn --small">
    <div>
        <div class="action-group" wire:ignore.self >
            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li><a class="button button-accent button-small button-icon ico_plus" href="{{ route('admin.brands.create')}}"></a></li>
                    @if(isset($selectedData) AND count($selectedData)>0)
                      <li><button class="ico_trash" type="button"  data-bs-target="#dellModeAll" data-bs-toggle="modal"></button></li>
                      @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
            </div>
    </div>
</div>
<table class="js-table js-table_new table-td-small footable">
    <thead>
        <tr>
            <th style="display: table-cell;">
                <div class="d-flex align-items-center">
                    <label class="check js-select-all">
                        <input class="check__input" type="checkbox"  @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" />
                        <span class="check__box"></span>
                    </label><span>@lang('custom::admin.Name')</span></div>
            </th>
            <th class="text-md-center" style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Activity')</th>
                <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Order')</th>
            <th class="text-end text-xl-center w-1" style="display: table-cell;" data-breakpoints="xs">
            </th>
        </tr>
    </thead>
    <tbody>
@if($data_paginate AND count($data_paginate)>0)
        @foreach ($data_paginate as $key=>$item)
        <tr>
            <td class="w-100" style="display: table-cell;">
                <div class="box-brand">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')"  />
                        <span class="check__box"></span></label>
                    @if(isset($item->mainImage->url))
                    <img src="{{ $item->mainImage->url ? \Storage::disk('public')->url($item->mainImage->url) : '' }}" alt="image">
                    @endif
                    <a href="{{route('admin.brands.edit',$item->id)}}"> @if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif</a></div>
            </td>
            <td  class="text-md-center" style="display: table-cell;">
                <label class="check eye"><input class="check__input" type="checkbox"  onclick="@this.changeStatusData({{$item->id}},'status')" @if($item->status == 0) checked="checked" @endif/><span class="check__box"></span></label>
            </td>
            <td class="text-md-center" style="display: table-cell;">
                    <input class="form-control form-xs" type="number"  value="{{ $item->order }}" onchange="changeOrderCustom({{$item->id}}, this.value, this)">
                </td>
            <td class="text-end text-md-center" style="display: table-cell;">
                  <div class="button-group">
                      <a class="button button-small button-icon ico_edit" href="{{route('admin.brands.edit',$item->id)}}"></a>
                 </div>
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
@if($data_paginate AND count($data_paginate)>0)

    @foreach ($data_paginate as $key=>$item)
        @include('livewire.admin.includes.scripts_data',['on_click'=>'destroyData('.$item->id.')','key'=>$item->id, 'title'=>'Сторінку: '.$item->title])
    @endforeach

        @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])


        @include('livewire.admin.includes.per-page-table')

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
