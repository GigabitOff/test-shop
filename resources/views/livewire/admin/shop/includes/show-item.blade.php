<div class="table-before-btn --small">
              <div>
                <div class="action-group">
                  <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li><a class="button button-accent button-small button-icon ico_plus" href="{{route('admin.shops.create')}}"></a></li>
                    @if(isset($selectedData) AND count($selectedData)>0)
                      <li><button class="ico_trash" type="button"  data-bs-target="#dellModeAll" data-bs-toggle="modal"></button></li>
                      @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
<table  class="js-table js-table_new footable">
        <thead>
            <tr class="footable-header">
                <th scope="col-6" class="footable-first-visible" style="display: table-cell;">
                    <label class="check js-select-all">
                          <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" />
                          <span class="check__box"></span></label>
                          @lang('custom::admin.Name')
                </th>
                <th class="text-md-center w-1" style="display: table-cell;">@lang('custom::admin.Activity')</th>
                <th class="text-md-center w-1" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Order')</th>
                <th class="text-end w-1 footable-last-visible" style="display: table-cell;">
                </th>
            </tr>
        </thead>
        <tbody>
        @if($data_paginate AND count($data_paginate)>0)
            @foreach ($data_paginate as $key=>$item)
            <tr>
                <td class="footable-first-visible" style="display: table-cell;">
                    <div class="box">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')" ><span class="check__box"></span>
                    </label>
                    @if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif
                </div>
                </td>
                <td class="text-md-center w-1" style="display: table-cell;"><label class="check eye" >
                    <input class="check__input" type="checkbox" @if($item->status == 0)  checked="checked" @endif  onclick="@this.changeStatus({{$item['id']}});" /><span class="check__box"></span></label></td>
                <td class="text-md-center w-1" style="display: table-cell;">
                    <input class="form-control form-xs" type="number"  value="{{ $item->order }}" onchange="changeOrderShops({{$item->id}}, this.value, this)">
                </td>
                <td class="text-end w-1 footable-last-visible" style="display: table-cell; ">
                    @if(isset($action_type))
                    <button type="button"  class="button button-small button-icon ico_edit" wire:click="editDataItem('{{ $item->id }}')">
                                @lang('custom::admin.Edit')
                    </button>
                    @else
                    <a class="button button-small button-icon ico_edit" href="{{ route('admin.shops.edit', [$item->id]) }}"></a>
                    @endif
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

          @include('livewire.admin.includes.per-page-table')
            @endif
    </div>
        @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])

<div wire:ignore>
<script>
    function changeOrderShops(id_s, values, input){

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
        @this.changeOrderCustomSingle(id_s,values);

    }
</script>
</div>
