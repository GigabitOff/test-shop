<div>
    {{-- In work, do what you enjoy. --}}
          <h4 class="text-center text-xl-start">@lang('custom::admin.bonus.discount')</h4>
          <div class="table-before-btn --small --diskont">
            <div>
              <div class="action-group">
                <div class="action-group-btn"><span class="ico_submenu"></span></div>
                <div class="action-group-drop">
                  <ul class="action-group-list">
                    <li><a class="ico_plus" href="{{route('admin.bonus.discount.create')}}"></a></li>
                    <li><button class="ico_trash" type="button"></button></li>
                    <li><button class="js-hide-drop ico_close" type="button"></button></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <table class="js-table table-td-small footable footable-1 footable-paging footable-paging-right breakpoint-lg" data-paging-size="7" style="">
            <thead>
              <tr class="footable-header">

              <th class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center">
                    <label class="check js-select-all">
                        <input class="check__input" type="checkbox"><span class="check__box"></span></label><span>@lang('custom::admin.Name')</span>
                </div>
                </th>
                <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Date start')</th>
                <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Date end')</th>
                <th class="text-md-center" data-breakpoints="xs sm md" style="display: table-cell;">@lang('custom::admin.Activity')</th>
                <th class="text-end text-md-center footable-last-visible" data-breakpoints="xs sm md" style="display: table-cell;"></th>
            </tr>
            </thead>
            <tbody>
        @if($data_paginate AND count($data_paginate)>0)
            @foreach ($data_paginate as $key=>$item)
            <tr>
              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')"  />
                        <span class="check__box"></span></label>
                        <a href="{{route('admin.bonus.discount.edit',$item->id)}}">@if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif</a></div>
                </td>
                <td class="text-md-center" style="display: table-cell;">{{ \Carbon\Carbon::parse($item->date_start)->format('d.m.Y') }}</td>
                <td class="text-md-center" style="display: table-cell;">{{ \Carbon\Carbon::parse($item->date_end)->format('d.m.Y') }}</td>
                <td class="text-center" style="display: table-cell;">
                <label class="check eye"><input class="check__input" type="checkbox"  onclick="@this.changeStatusData({{$item->id}},'status')" @if($item->status == 0) checked="checked" @endif/><span class="check__box"></span></label>
                </td>
                <td class="text-end text-md-center footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.discount.edit',$item->id)}}">
                </a>
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

          @foreach ($data_paginate as $key=>$item)
            @if($item->slug != 'main')
              @include('livewire.admin.includes.scripts_data',['on_click'=>'destroyData('.$item->id.')','key'=>$item->id, 'title'=>'Сторінку: '.$item->title])
            @endif
            @endforeach
        @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])
          @include('livewire.admin.includes.per-page-table')
            @endif
    </div>
</div>
