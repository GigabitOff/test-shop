<table>
    <thead>
    <tr>
        <th class="footable-first-visible" >
            <div class="d-flex align-items-center">
                <label class="check js-select-all">
                    <input class="check__input" type="checkbox"
                           id="check-row-all"
                           @if(isset($selectedData['all'])) checked @endif
                           onclick="document.pageHandlers.selectDataItem('all',true)"/><span class="check__box"></span>
                </label>
                <span>ID</span>
            </div>
        </th>
        <th>@lang('custom::admin.products.Name')</th>
        <th data-breakpoints="xs">@lang('custom::admin.products.Articul')<br>
            @lang('custom::admin.products.Brand')</th>
        <th data-breakpoints="xs">@lang('custom::admin.products.Price sell')</th>
        <th data-breakpoints="xs">@lang('custom::admin.products.Product category')</th>
        <th data-breakpoints="xs">@lang('custom::admin.products.Availability')
            <br>
            @lang('custom::admin.products.Count') /
            @lang('custom::admin.products.reserve')
        </th>
        <th data-breakpoints="xs">@lang('custom::admin.Activity')</th>
        <th class="text-end w-1"  data-breakpoints="xs">
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data_paginate as $key=>$item)
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <label class="check">
                        <input class="check__input" type="checkbox"
                               id="check-row-{{$item->id}}"
                               @if(isset($selectedData[$item->id])) checked @endif
                               onclick="document.pageHandlers.selectDataItem({{$item->id}})"/>
                        <span class="check__box"></span>
                    </label>
                    <span class="ms-2">{{$item->id}}</span>
                </div>
            </td>
            <td>
                <a href="{{ route('admin.product.edit',$item->id) }}">@if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->name)){{$item->translate(session('lang'))->name}}@else{{config('app.fallback_locale') }}@endif</a>
            </td>
            <td>
                <div class="box-info">
                    @if($item->attributesMessage)
                        <div>
                            <div class="info"><span class="ico_warning"></span>
                                <div class="info-drop">
                                    {!! $item->attributesMessage !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div>
                        <span class="d-block nowrap">№ {{ isset($item->articul) ? $item->articul: '---' }}</span>
                        <span
                            class="d-block nowrap">
                            @if(isset($item->brand) AND $item->brand->translate(session('lang'))!==null AND isset($item->brand->translate(session('lang'))->title)){{$item->brand->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif

                    </div>
                </div>
            </td>
            <td class="text-xl-center">
                <span>{{ isset($item->price) ? round($item->price,2): '---' }} @lang('custom::admin.products.UAH')</span>
            </td>
            <td>
                <div class="box-info">
                    @if($item->categoryMessage)
                        <div>
                            <div class="info"><span class="ico_warning"></span>
                                <div class="info-drop">
                                    {!! $item->categoryMessage !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div>
                        @if($item->categoryName)
                            <span>{{$item->categoryName}}</span>
                        @endif
                    </div>
                </div>
            </td>
            <td>
                    <span class="status nowrap"
                          @if($item->availabilityColor)
                              style="color: {{$item->availabilityColor}};"
                          @endif
                            >{{$item->availabilityText}}</span>
                <span class="d-block nowrap">{{ $item->stock }} / {{ $item->reserve }}</span>
            </td>
            <td class="text-xl-center w-1">
                <label class="check eye">
                    <input class="check__input" type="checkbox"
                           id="check-status-{{$item->id}}"
                           onclick="document.pageHandlers.changeStatusData({{$item->id}},'status')"
                           @if($item->status == 0) checked="checked" @endif/><span
                        class="check__box"></span>
                </label>
            </td>
            <td class="text-end w-1" >
                <a class="button button-small button-icon ico_edit"
                   href="{{route('admin.product.edit',$item->id)}}"></a>

            </td>
        </tr>
    @endforeach

    </tbody>

</table>



