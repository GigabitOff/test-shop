<div class="table-before-btn --small">
    <div>
        <div class="action-group" style="margin-right: 2px;">
            <div class="action-group-btn"><span class="ico_submenu"></span></div>
            <div class="action-group-drop">
                <ul class="action-group-list">
                    <li><a class="button button-accent button-small button-icon ico_plus"
                           href="{{ route('admin.'.$nameLive.'.create')}}"></a></li>
                    @if(isset($selectedData) AND count($selectedData)>0)
                        <li>
                            <button class="ico_trash" type="button" data-bs-target="#dellModeAll"
                                    data-bs-toggle="modal"></button>
                        </li>
                    @endif
                    <li>
                        <button class="js-hide-drop ico_close" type="button"></button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<table class="js-table js-table_new footable">
    <thead>
    <tr>
        <th scope="col-6" style="display: table-cell;" class="footable-first-visible">
            <div class="d-flex align-items-center">
                <label class="check js-select-all">
                    <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked
                           @endif  onclick="@this.selectDataItem('all',true)"/>
                    <span class="check__box"></span>
                </label>
                <span>@lang('custom::admin.Name price')</span></div>
        </th>
        <th class="text-md-center" style="display: table-cell;">@lang('custom::admin.product_imports.type')</th>
        <th class="text-md-center"
            style="display: table-cell;">@lang('custom::admin.product_imports.last_processed')</th>
        <th class="text-md-center"
            style="display: table-cell;">@lang('custom::admin.product_imports.errors')</th>
        @if(!app()->isProduction())
        <th class="text-md-center" title="Додано тільки для тестування"
            style="display: table-cell;">@lang('custom::admin.Audit')
        </th>
        @endif
        <th class="text-md-center" style="display: table-cell;">@lang('custom::admin.Activity')</th>
        <th class="text-end w-1 footable-last-visible" style="display: table-cell;">
        </th>
    </tr>
    </thead>
    <tbody>
    @if($data_paginate AND count($data_paginate)>0)
        @foreach ($data_paginate as $key=>$item)
            <tr>
                <td style="display: table-cell;" class="footable-first-visible">
                    <div class="box">
                        <label class="check">
                            <input class="check__input" type="checkbox"
                                   @if(isset($selectedData[$item->id])) checked="checked"
                                   @endif onclick="@this.selectDataItem('{{ $item->id }}')"/>
                            <span class="check__box"></span></label>
                        @if(\Storage::disk('public')->exists($item->image))
                            <img src="{{ \Storage::disk('public')->url($item->image) }}" alt="">
                        @endif
                        {{--                        <a href="{{ route('admin.'.$nameLive.'.edit', [$item->id]) }}">@if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif</a>--}}
                        <a href="{{ route('admin.'.$nameLive.'.edit', [$item->id]) }}">{{ $item->name }}</a>
                    </div>
                </td>

                <td style="display: table-cell;" class="text-md-center">
                    {{$item->type}}
                </td>

                <td style="display: table-cell;" class="text-md-center">
                    @if($item->processed_at)
                        {{$item->processed_at->format('d.m.Y H:i')}}
                    @else
                        @lang('custom::admin.product_imports.not_processed')
                    @endif
                </td>

                <td style="display: table-cell;" class="text-md-center">
                    @if($item->errors)
                        <div class="button-group">
                            <button class="button button-accent button-small button-icon ico_download"
                                    onclick="document.productImports.downloadErrors({{$item->id}})"
                            ></button>
                        </div>
                    @else
                        @lang('custom::admin.product_imports.not_found')
                    @endif
                </td>
                @if(!app()->isProduction())
                    <td style="display: table-cell;" class="text-md-center" title="Додано тільки для тестування">
                        @if($item->isStateProcessing())
                            Виконуєтся
                        @else
                            <div class="button-group">
                                <button class="button button-accent button-small"
                                        onclick="document.productImports.startImport({{$item->id}})"
                                >Старт</button>
                            </div>
                        @endif
                    </td>
                @endif

                <td style="display: table-cell;" class="text-md-center">
                    <label class="check eye">
                        <input class="check__input" type="checkbox"
                               onclick="@this.changeStatusData({{$item->id}},'status')"
                               @if($item->status == 0) checked="checked" @endif/><span
                            class="check__box"></span></label>
                </td>
                <td class="text-end w-1 footable-last-visible" style="display: table-cell;">
                    <a class="button button-small button-icon ico_edit"
                       href="{{route('admin.'.$nameLive.'.edit',$item->id)}}"></a>

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


<script>
    document.productImports = {
        downloadErrors: function (id) {
        @this.downloadErrors(id);
        },
        startImport: function (id) {
        @this.startImport(id);
        },
    }

    //# sourceUrl=product-import-index.js
</script>
