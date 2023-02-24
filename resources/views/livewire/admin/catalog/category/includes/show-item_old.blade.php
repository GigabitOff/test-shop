<div class="table-before-btn --small">
    <div >
            <div class="action-group" style="margin-right:3px; margin-top:10px;" >
              <div class="action-group-btn"><span class="ico_submenu"></span></div>
              <div class="action-group-drop" >
                <ul class="action-group-list">
                   <li><a href="{{ route('admin.'. $nameLive .'.create') }}" class="ico_plus"></a></li>
                        @if(isset($selectedData) AND count($selectedData)>0)
                            <li><button class="ico_trash" type="button"  data-bs-target="#dellModeall" data-bs-toggle="modal"></button></li>
                        @endif
                        <li><button class="js-hide-drop ico_close" type="button"></button></li>
                </ul>
              </div>
            </div>
        </div>
          </div>
<table class="js-table js-table_new table-td-small footable" id="tableCategories">
            <thead >
              <tr class="footable-header">
                  <th  style="display: table-cell;" class="footable-first-visible">
                  <div class="d-flex align-items-center">
                     {{-- <label class="check js-select-all" >
                      <input class="check__input" @if(isset($selectedData['all'])) checked @endif  onclick="@this.selectDataItem('all',true); "  type="checkbox" />
                      <span class="check__box"></span>
                    </label>
                    <button style="margin-left: 6px;" class="flag @if($mainCategory)is-active @endif" type="button" onclick="@this.showMainCategories(@if($this->mainCategory == true){{false}}@else{{true}}@endif)"></button>--}}
                    <span>@lang('custom::admin.catalog.Category name')</span></a>
                </div>
                </th>
                <th style="display: table-cell;">@lang('custom::admin.Parent category')</th>
                <th style="display: table-cell;" class="text-center">@lang('custom::admin.Order')</th>
                <th class="w-1 text-md-center" style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Activity')</th>

                <th style="display: table-cell;" class="text-center w-1 footable-last-visible">

                </th>
              </tr>
            </thead>
@if(isset($data_paginate) AND count($data_paginate)>0)

            <tbody  {{--wire:sortable="updateOrder"--}} >
            @foreach ($data_paginate as $key=>$item)
              <tr {{--wire:sortable.item="{{ $item->id }}" wire:key="zmist-menu-{{ $item->id }}"--}}>
                <td style="display: table-cell;" class="footable-first-visible">
                  <div class="d-flex align-items-center"><label class="check">
                      <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')"/><span class="check__box"></span></label>
                      <a class="flag ms-2 @if($item->parent_id == 0)is-active @endif" href="{{ route('admin.'. $nameLive .'.edit', [$item->id]) }}">{{ isset($item->name) ? $item->name: '' }}</a></div>
                </td>
                <td style="display: table-cell;"><span>{{  $item->selfCategory !== null ? $item->selfCategory->name : '' }}</span></td>

                <td style="display: table-cell;" class="text-md-center">
                    <input class="form-control form-xs" type="number" placeholder="1" value="{{ $item->sort_order }}" onchange="changeOrderCustom({{$item->id}},this.value, {{$item->parent_id}}, this)"></td>
                <td  class="w-1 text-md-center" style="display: table-cell;">
                    <label class="check eye">
                        <input class="check__input" type="checkbox"  onclick="@this.changeStatusData({{$item->id}},'status')" @if($item->status == 0) checked="checked" @endif/>
                        <span class="check__box"></span>
                    </label>
                </td>
                <td style="display: table-cell;" class="text-center w-1 footable-last-visible">
                    @include('livewire.admin.catalog.category.includes.actions-index',['item_action'=>$item])

                </td>
              </tr>
              @if($mainCategory)
               @if($item->child_data AND count($item->child_data))
                    @include('livewire.admin.catalog.category.includes.includes-categories',['parentData'=>$item->child_data])
                @endif
                @endif
            @endforeach
            </tbody>

            @else
                <tr>
                    <td class="text-center" style="display: table-cell;" colspan="5">
                @lang('custom::admin.No data available')

                    </td>

                </tr>
@endif

    </table>

<script>
    function changeOrderCustom(id_s, values, parent_id, input){


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


       @this.changeOrderCustom(id_s, values, parent_id);

    }
</script>

            @include('livewire.admin.includes.scripts_data',['on_click'=>'destroyAllData()','key'=>'all', 'title'=>''])

          @include('livewire.admin.includes.per-page-table')



