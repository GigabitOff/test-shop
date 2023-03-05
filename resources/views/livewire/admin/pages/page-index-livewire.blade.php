<div class="container-small">

    {{--<div class="table-before-btn --small"><a class="button button-small button-accent button-icon ico_plus" href="{{ route('admin.pages.create') }}" style="margin-right:-5px;"></a></div>--}}

    <table class="table-shop-pages js-table js-table_new table-td-small footable">
        <thead>
        <tr>
            <th class="w-100 footable-first-visible" style="display: table-cell;">@lang('custom::admin.Page name')</th>
            <th class="text-md-center " style="display: table-cell;">@lang('custom::admin.Page count')</th>
            <th style="display: table-cell;" class="text-center"
                data-breakpoints="xs">@lang('custom::admin.Activity')</th>
            <th style="display: table-cell; footable-last-visible" data-breakpoints="xs">
            </th>
        </tr>
        </thead>
        @if(isset($data_paginate) AND count($data_paginate)>0)
            <tbody>
            @foreach ($data_paginate as $key=>$item)
                <tr>
                    <td class="w-100 footable-first-visible" style="display: table-cell;">@php
                            $route_edit = route('admin.pages.edit', [$item->id]);

                            if(\Route::has('admin.'.$item->slug.'.index'))
                            $route_edit = route('admin.'.$item->slug.'.index');

                            if(\Route::has('admin.pages.'.$item->slug.''))
                            $route_edit = route('admin.pages.'.$item->slug.'');

                            if($item->slug == 'contacts')
                            $route_edit = route('admin.shops.index');

                        @endphp

                        @if($item->slug != 'main')

                            <a href="{{ $route_edit }}">@if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title))
                                    {{$item->translate(session('lang'))->title}}
                                @else
                                    {{config('app.fallback_locale') }}
                                @endif</a>
                        @else
                            <a href="{{ route('admin.pages.'.$item->slug.'')}}">@if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title))
                                    {{$item->translate(session('lang'))->title}}
                                @else
                                    {{config('app.fallback_locale') }}
                                @endif</a>
                        @endif
                    </td>
                    <td class="text-center " style="display: table-cell;"><span
                            class="min-width">{{ isset($count_data[$item->slug]) ? $count_data[$item->slug] : (count($item->PageChild)>0 ? count($item->PageChild) : '') }}</span>
                    </td>
                    <td class="text-md-center" style="display: table-cell;">
                        @if($item->slug != 'main')
                            <label class="check eye"
                                   onclick="@this.changeStatus({{$item['id']}},{{ $item->status == 0 ? 1 : 0}});"><input
                                    class="check__input" type="checkbox"
                                    @if($item->status == 0)  checked="checked" @endif /><span class="check__box"></span></label>
                        @endif
                    </td>
                    <td class="text-end footable-last-visible" style="display: table-cell;">

                        @if($item->slug != 'main')

                            <div class="button-group"><a class="button button-small button-icon ico_edit"
                                                         href="{{ $route_edit }}"></a>

                                <button class="button button-small button-icon ico_trash"
                                        title="@lang('custom::admin.Del')" type="button"
                                        data-bs-target="#dellMode{{$item->id}}" data-bs-toggle="modal"></button>
                            </div>
                        @else
                            <div class="button-group flex-row">
                                <div>
                                    <a class="button button-small button-icon ico_edit" href="{{ $route_edit }}"></a>
                                </div>
                                <div></div>
                            </div>

                        @endif

                    </td>

                </tr>
            @endforeach
            </tbody>

        @endif
    </table>
    @if(isset($data_paginate) AND count($data_paginate)>0)

        @foreach ($data_paginate as $key=>$item)
            @if($item->slug != 'main')
                @include('livewire.admin.includes.scripts_data',['wire_click'=>'destroyData('.$item->id.')','key'=>$item->id, 'title'=>'Сторінку: '.(($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)) ? $item->translate(session('lang'))->title : config('app.fallback_locale') )])
            @endif
        @endforeach
        @include('livewire.admin.includes.per-page-table')
    @endif
</div>
