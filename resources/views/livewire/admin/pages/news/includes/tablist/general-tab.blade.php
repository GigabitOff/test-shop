
<div class="table-before-btn --small">
              <div>
                <div class="action-group">
                  <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li><a class="button button-accent button-small button-icon ico_plus" href="{{route('admin.news.create')}}"></a></li>
                    @if(isset($selectedData) AND count($selectedData)>0)
                      <li><button class="ico_trash" type="button"  data-bs-target="#dellModeAll" data-bs-toggle="modal"></button></li>
                      @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        <table class="js-table js-table_new footable">
        <thead>
            <tr>
                <th scope="col-6" style="display: table-cell;" class="footable-first-visible">
                    <label class="check js-select-all">
                          <input class="check__input" type="checkbox"  @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" />
                          <span class="check__box"></span></label>
                          @lang('custom::admin.Name News')
                        </th>
                <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Date publisher')</th>
                <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Activity')</th>
                <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Order')</th>
                <th class="text-end w-1 footable-last-visible" data-breakpoints="xs" style="display: table-cell;"></th>
            </tr>
        </thead>
        <tbody  {{--wire:sortable="updateOrder"--}}>
           @if($data_paginate AND count($data_paginate)>0)
            @foreach ($data_paginate as $key=>$item)
            <tr {{--wire:sortable.item="{{ $item->id }}" wire:key="zmist-menu-{{ $item->id }}"--}}>
                <td style="display: table-cell;" class="footable-first-visible">
                    <div class="box">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')" ><span class="check__box"></span>
                    </label>
                        @if($item->image_small  AND \Storage::disk('public')->exists($item->image_small))
                        <img src="{{ \Storage::disk('public')->url($item->image_small) }}" alt="{{ $item->title }}">
                        @endif
                        <a href="{{ route('admin.news.edit', [$item->id]) }}">@if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif</a>
                    </div>
                </td>
                <td  class="text-md-center" style="display: table-cell;">
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}
                </td>
                <td  class="text-md-center" style="display: table-cell;">
                    <label class="check eye"><input class="check__input" type="checkbox"  onclick="@this.changeStatusData({{$item->id}},'status')" @if($item->status == 0) checked="checked" @endif/><span class="check__box"></span></label>
                </td>
                <td class="text-md-center" style="display: table-cell;">
                    <input class="form-control form-xs" type="number"  value="{{ $item->order }}" onchange="changeOrderCustom({{$item->id}}, this.value, this)">
                </td>
                <td class="text-end w-1 footable-last-visible" style="display: table-cell;">
                    <a class="button button-small button-icon ico_edit" href="{{ route('admin.news.edit', [$item->id]) }}"></a>
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
            @endif
    </div>
        @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])


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
