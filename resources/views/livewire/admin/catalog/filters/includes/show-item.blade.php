<div class="table-before-btn --small">
              <div>
                <div class="action-group">
                  <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li><a class="button button-accent button-small button-icon ico_plus" href="{{route('admin.filters.create')}}"></a></li>
                    @if(isset($selectedData) AND count($selectedData)>0)
                      <li><button class="ico_trash" type="button"  data-bs-target="#dellModeAll" data-bs-toggle="modal"></button></li>
                      @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
<table class="js-table js-table_new table-td-small  footable" >
    <thead>
        <tr  class="footable-header">
            <th scope="col-6" style="display: table-cell;" class="footable-first-visible">
                <label class="check js-select-all">
                          <input class="check__input" @if(isset($selectedData['all'])) checked @endif  type="checkbox" onclick="@this.selectDataItem('all',true)" />
                          <span class="check__box"></span></label>
                @lang('custom::admin.The name of the module for the filter')
            </th>
            <th class="text-md-center" style="display: table-cell;">@lang('custom::admin.category')</th>
            <th class="text-md-center" style="display: table-cell;">@lang('custom::admin.Activity')</th>
            <th class="text-end text-md-center w-1 footable-last-visible" style="display: table-cell;"></th>
        </tr>
    </thead>
@if(isset($data_paginate) AND count($data_paginate)>0)
    <tbody>
        @foreach ($data_paginate as $key=>$item)
        <tr>
            <td class="w-100 footable-first-visible" style="display: table-cell;">
                <div class="box">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')" ><span class="check__box"></span>
                    </label>
                <a href="{{ route('admin.filters.edit',$item->id) }}">
                    {{ (is_object($item->translate(session('lang'), true)) AND isset($item->translate(session('lang'), true)->title)) ? $item->translate(session('lang'), true)->title : $item->name }}
                </a>
            </div>
            </td>
            <td class="text-md-center" style="display: table-cell;">
                <span class="nowrap">{{$item->categoryName}}</span>
            </td>
            <td class="text-md-center" style="display: table-cell;"><label class="check eye" >
                <input class="check__input" type="checkbox" onclick="@this.changeStatus({{$item['id']}});" @if($item->status == 0)  checked="checked" @endif /><span class="check__box"></span></label></td>
            <td class="text-end text-md-center w-1 footable-last-visible" style="display: table-cell;">
                @include('livewire.admin.catalog.filters.includes.actions-index',['item_action'=>$item])
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif

</table>


@if(isset($data_paginate) AND count($data_paginate)>0)
@foreach ($data_paginate as $key=>$item)
    @include('livewire.admin.includes.scripts_data',['on_click'=>'destroyData('.$item->id.')','key'=>$item->id, 'title'=>'Сторінку: '.$item->title])
    @endforeach

        @include('livewire.admin.includes.per-page-table')

    @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])

@endif
