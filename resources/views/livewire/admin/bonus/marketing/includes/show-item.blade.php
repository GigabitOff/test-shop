@if(!$type)
<div class="table-before-btn --small --table-main-banner">
    <div>
        <div class="action-group" style="margin-right: 2px;">
            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li>
                        <a class="button button-accent button-small button-icon ico_plus" href="{{ route('admin.banners.create')}}"></a>
                        </li>
                    @if(isset($selectedData) AND count($selectedData)>0)
                      <li><button class="ico_trash" type="button"  data-bs-target="#dellModeAll" data-bs-toggle="modal"></button></li>
                    @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
            </div>
    </div>

</div>
<table class="js-table js-table_new table-banner footable">
    <thead>
        <tr>
            <th style="display: table-cell;" class="footable-first-visible">
                <div class="d-flex align-items-center">
                    <label class="check js-select-all">
                        <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif  onclick="@this.selectDataItem('all',true)" />
                        <span class="check__box"></span>
                    </label><span>@lang('custom::admin.Name')</span></div>
            </th>
            <th data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Link')</th>
            <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Type of allocation')</th>
            <th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Activity')</th>
            <th class="text-end w-1 footable-last-visible" style="display: table-cell;">
            </th>
        </tr>
    </thead>
    <tbody>
        @if($data_paginate AND count($data_paginate)>0)
        @foreach ($data_paginate as $key=>$item)
              <tr>

                <td style="display: table-cell;" class="footable-first-visible">
                    <div class="box-banners">
                        <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')"  />
                        <span class="check__box"></span></label>
                        @if(\Storage::disk('public')->exists($item->image))<img width="100" src="{{ \Storage::disk('public')->url($item->image) }}" alt="@if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif">
                        @endif
                        <a href="{{ route('admin.banners.edit',$item->id)}}">
                            @if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif
                        </a>
                    </div>
                </td>
                <td style="display: table-cell;"><a class="short-link accent"  target="_blank" href="{{ $item->translate(session('lang')) !== null ? $item->translate(session('lang'))->url : '' }}">{{ $item->translate(session('lang')) ? $item->translate(session('lang'))->url : '' }}</a></td>
                <td class="text-md-center " style="display: table-cell;">
                    <span>
                        {{ $item->page ? $item->page->title : '' }}
                    </span>
                </td>
                <td class="text-md-center " style="display: table-cell;">
                    <label class="check eye">
                        <input onclick="@this.changeStatusData({{$item['id']}});"  class="check__input" type="checkbox" @if($item->status == 0)  checked="checked" @endif />
                        <span class="check__box"></span></label>
                </td>
                <td class="text-end w-1 footable-last-visible" style="display: table-cell;">
                      <a class="button button-small button-icon ico_edit" href="{{route('admin.banners.edit',$item->id)}}"></a>
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
        @include('livewire.admin.includes.per-page-table')</div>

  @else
<div class="table-before-btn --small --table-main-banner">
    <div>
        <div class="action-group" style="margin-right: 2px;">
            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li>
                        <button class="button button-accent button-small button-icon ico_plus" type="button" wire:click="startNewData" data-bs-target="#m-add-banner" data-bs-toggle="modal"></button>
                        </li>
                    @if($this->isDataDeletedChecked())
                      <li><button class="ico_trash" type="button"  onclick="@this.deleteDatas()"></button></li>
                     @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
            </div>
    </div>
</div>
<table class="js-table js-table_new table-banner table-td-small footable">
    <thead>
        <tr class="footable-header">
            <th class="w-100" style="display: table-cell;">
                <div class="d-flex align-items-center">
                    <label class="check js-select-all">
                        <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif  onclick="@this.selectDataItemAll('all',true)" />
                        <span class="check__box"></span>
                    </label><span>@lang('custom::admin.Name')</span></div>
            </th>
            <th data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Link')</th>
            <th class="text-sm-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Activity')</th>
            <th class="text-sm-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Order')</th>
            <th class="text-end w-1 "></th>
        </tr>
    </thead>
    <tbody  wire:sortable="updateOrderTmp">
        @php($L=0)
        @foreach ($all_data as $key => $item)
            @continue($this->isDataDeleted($item))
            <tr wire:key="zmist-menu-{{ $key }}">
                <td style="display: table-cell;">
                    <div class="box">
                        <label class="check">
                            <input class="check__input" type="checkbox"
                                   @if($item['checked'] ?? false) checked="checked" @endif
                                   onclick="@this.setCheckedData('{{ $key }}', this.checked)"/>
                            <span class="check__box"></span></label>
                        @if(!empty($item['image']) AND  $this->getImageSrc($item['image']))
                            <img src="{{ $this->getImageSrc($item['image']) }}"
                                 alt="{{ $item[session('lang')]['title'] ?? '' }}">
                        @endif
                        <a data-bs-target="#m-main-item" data-bs-toggle="modal"
                           onclick="startEditData('{{ $item['key'] }}');"
                           href="javascript:void(0);">
                            {!! $item[session('lang')]['title'] ?? '' !!}
                        </a>
                    </div>
                </td>
                <td style="display: table-cell;">
                    <a class="short-link accent" target="_blank"
                       href="{{ $item[session('lang')]['url'] ?? '' }}">{{ $item[session('lang')]['url'] ?? '' }}</a>
                </td>
                <td class="text-sm-center" style="display: table-cell;">
                    <label class="check eye">
                        <input class="check__input"
                               @if(!$item['status'])  checked="checked" @endif
                               onclick="mainDataBanner.setStatusData('{{$item['key']}}', !this.checked);"
                               type="checkbox"/>
                        <span class="check__box"></span>
                    </label>
                </td>
                <td class="text-sm-center" style="display: table-cell;">
                    <input class="form-control form-xs" type="text" placeholder="1" value="{{ isset($item['order']) ? $item['order'] : $item['newOrder'] ?? $item['newOrder']}}" onchange="@this.changeOrderCustomTmp('{{$key}}',this.value)"  wire:model.lazy="all_data.{{$key}}.order">
                </td>
                <td class="text-sm-center text-end w-1" style="display: table-cell;">
                    {{--                    <button title="Видалити" class="button button-small button-icon ico_trash"--}}
                    {{--                            onclick="deleteData('{{$item['key']}}')"--}}
                    {{--                            type="button"></button>--}}
                    <a class="button button-small button-icon ico_edit"
                       data-bs-target="#m-add-banner" data-bs-toggle="modal"
                       href="javascript:void(0);"
                       onclick="mainDataBanner.startEditData('{{ $item['key'] }}');"></a>
                </td>
            </tr>
            @php($L++)
        @endforeach
        @if($L==0)
       <tr>
                <td class="text-center" style="display: table-cell;" colspan="5">
                    @lang('custom::admin.No data available')
                </td>
            </tr>
        @endif
    </tbody>
</table>         {{-- Баннери на головній --}}

@endif

<div>
        @if(isset($data_paginate) AND count($data_paginate)>0)

          @foreach ($data_paginate as $key=>$item)

              @include('livewire.admin.includes.scripts_data',['on_click'=>'destroyData('.$item->id.')','key'=>$item->id, 'js_class'=>'table-banner', 'title'=>'Сторінку: '.$item->title])

            @endforeach
            @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])
            @endif
    </div>
<script>
    function startEditData(id) {
       // $('#message_banner').show();
       // @this.editBanner(id);
    }
</script>

<script>
        window.mainDataBanner = {

            startEditData: function (key) {
                $('#message_banner').show();
            @this.startEditData(key);
            },
            deleteData: function (key) {
                @this.deleteData(key);
            },

            setStatusData: function (key, value) {
                @this.setStatusData(key, value);
            },
        }

        // document.addEventListener('updateFootableData', ()=>{
        //     changeTableFoot(0, 'table-item');
        // })
    </script>

