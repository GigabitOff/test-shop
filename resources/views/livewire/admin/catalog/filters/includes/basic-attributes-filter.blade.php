<table  class="js-table js-table_new filter-base-attr-table footable" >
    <thead>
        <tr>
            <th class="footable-first-visible" style="display: table-cell;">@lang('custom::admin.Name attribute')</th>
            <th style="display: table-cell;">@lang('custom::admin.Status')</th>
            <th style="display: table-cell;" class="text-center w-1" data-breakpoints="xs">@lang('custom::admin.Order')</th>
            <th style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Display type')</th>
            {{--<th style="display: table-cell;" data-breakpoints="xs sm md">@lang('custom::admin.Display method')</th>--}}
            <th style="display: table-cell;" cdata-breakpoints="xs sm md">@lang('custom::admin.Order type')</th>
            <th class="footable-last-visible" style="display: table-cell;" data-breakpoints="xs sm md">@lang('custom::admin.Settings')</th>
            {{--<th><button class="button button-accent button-small button-icon ico_plus" type="button" data-bs-target="#m-add-data-filter" data-bs-toggle="modal"></button></th>
        --}}</tr>
    </thead>

    <tbody>

    @if($data_paginate AND count($data_paginate)>0)
        @foreach ($data_paginate as $key_f=>$item_f)
        @if(isset($item_f->attribute))

        <tr>
            <td class="footable-first-visible" style="display: table-cell;">
                @if(!isset($item_f->attribute))

                <input class="form-control" type="text" placeholder="" value="{{ $item_f->translate(session('lang')) ? $item_f->translate(session('lang'))['title'] : $item_f['column_product']}}" onchange="@this.changeSingleFilterItem({{$item_f->id}},this.value)" >
                @else
            <span>
                        {{  $item_f->attribute->name}}
                    </span>
                @endif
                </td>
            <td style="display: table-cell;">
                <ul class="list-clear">
                    <li><label class="check --radio" >
                        <input onclick="changeStatusHtml('additional_st_{{$item_f['id']}}',{{$item_f['status']}},'additional_st_val_{{$item_f['id']}}'); @this.changeSingleItem({{$item_f['id']}}, 'status', {{ $item_f['status'] == 1 ? 0 : 1}})" class="check__input" id="additional_st_val_{{$item_f['id']}}" value="{{$item_f['status']}}" type="checkbox" @if($item_f['status'] == 1)checked="checked" @endif
                         /><span class="check__box" id="additional_st_{{$item_f['id']}}">@if($item_f['status'] == 1)@lang('custom::admin.Included')@else @lang('custom::admin.Offcluded')@endif</span>
                    </label>
                    </li>
                    <li><label class="check --radio" onclick="@this.changeSingleItem({{$item_f['id']}}, 'registered_user', {{ $item_f['registered_user'] == 1 ? 0 : 1}})">
                        <input class="check__input" type="checkbox"  @if($item_f['registered_user'] == 1)checked="checked" @endif />
                        <span class="check__box">@lang('custom::admin.For registered users')</span></label>
                    </li>
                </ul>
            </td>
            <td style="display: table-cell;" class="text-center w-1">
                @if($item_f['column_product'] != 'price_init')

                <input class="form-control form-xs" type="text" placeholder="@lang('custom::admin.Order')" value="{{$item_f['order']}}" onchange="changeOrderCustomBasic('{{$item_f['id']}}','order',this.value,this);">
                @endif
            </td>
            <td style="display: table-cell;">
                @if($item_f['column_product'] != 'price_init')
                <div class="js-dropdown-select dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>{{ $show_type[$item_f->show_type]['name']}}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end" style="">
                          <li class="dropdown-menu-title " >
                            <span>Тип отображения</span>
                            <span class="ico_close" data-bs-toggle="dropdown"></span>
                            </li>
                          <li class="dropdown-select-item @if($item_f->show_type == 'radio')is-active @endif"
                            onclick="@this.changeSingleItem({{$item_f->id}},'show_type','radio');">
                            <div class="dropdown-select-item__ico ico_dropdown-select-1"></div>
                            <div class="dropdown-select-item__txt">{{ $show_type['radio']['name']}}</div>
                          </li>
                          <li class="dropdown-select-item @if($item_f->show_type == 'checkbox')is-active @endif"
                          onclick="@this.changeSingleItem({{$item_f->id}},'show_type','checkbox');">
                            <div class="dropdown-select-item__ico ico_dropdown-select-2"></div>
                            <div class="dropdown-select-item__txt">{{ $show_type['checkbox']['name']}}</div>
                          </li>
                          <li class="dropdown-select-item @if($item_f->show_type == 'checkbox_icon')is-active @endif"
                            onclick="@this.changeSingleItem({{$item_f->id}},'show_type','checkbox_icon');">
                            <div class="dropdown-select-item__ico ico_dropdown-select-3"></div>
                            <div class="dropdown-select-item__txt">{{ $show_type['checkbox_icon']['name']}}</div>
                          </li>
                          <li class="dropdown-select-item @if($item_f->show_type == 'icon')is-active @endif"
                            onclick="@this.changeSingleItem({{$item_f->id}},'show_type','icon');">
                            <div class="dropdown-select-item__ico ico_dropdown-select-4"></div>
                            <div class="dropdown-select-item__txt">{{ $show_type['icon']['name']}}</div>
                          </li>
                          <li class="dropdown-select-item @if($item_f->show_type == 'select')is-active @endif"
                            onclick="@this.changeSingleItem({{$item_f->id}},'show_type','select');">
                            <div class="dropdown-select-item__ico ico_dropdown-select-5"></div>
                            <div class="dropdown-select-item__txt">{{ $show_type['select']['name']}}</div>
                          </li>
{{--                          <li class="dropdown-select-item @if($item_f->show_type == 'slider')is-active @endif"--}}
{{--                            onclick="@this.changeSingleItem({{$item_f->id}},'show_type','slider');">--}}
{{--                            <div class="dropdown-select-item__ico ico_dropdown-select-6"></div>--}}
{{--                            <div class="dropdown-select-item__txt">{{ $show_type['slider']['name']}}</div>--}}
{{--                          </li>--}}

                        </ul>
                      </div>   @endif
            </td>
            {{--<td style="display: table-cell;">
                @if($item_f['column_product'] != 'price_init')
                @include('livewire.admin.includes.select-data-arrow',[
                    'select_data_input'=>(isset($select_data['show_method']) ? $select_data['show_method']['id']: $item_f['show_method']),
                    'select_data_array'=>$show_method,
                    'placeholder'=>__('custom::admin.show_method'),
                    'index'=>'show_method',
                    'title_select'=>(isset($item_f['show_method']) ? __('custom::admin.filters_show_method.'.$item_f['show_method']): __('custom::admin.show_method')),
                    'data_type'=>'single',
                    'show_name'=>true,
                    'onclick'=>['id'=>$item_f['id'],'function'=>'changeSingleItem' ]])
                @endif
            </td>--}}
            <td style="display: table-cell;">
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['order_type']) ? $select_data['order_type']['id']: $item_f['order_type']),
                        'select_data_array'=>$order_type,
                        'placeholder'=>__('custom::admin.order_type'),'index'=>'order_type',
                        'title_select'=>(isset($item_f['order_type']) ? __('custom::admin.filters_order_type.'.$item_f['order_type']): __('custom::admin.order_type')),
                        'show_name'=>true,
                        'hide_clear' => true,
                        'data_type'=>'single',
                        'onclick'=>['id'=>$item_f['id'],'function'=>'changeSingleItem' ]
                        ])
                </td>
            <td class="footable-last-visible" style="display: table-cell;">
                <ul class="list-clear">
                @if($item_f['column_product'] != 'price_init')
                    <li><label class="check --radio"  onclick="@this.changeSingleItem({{$item_f['id']}}, 'show_title', {{ $item_f['show_title'] == 1 ? 0 : 1}})">
                        <input class="check__input" type="checkbox"  @if( $item_f['show_title'] == 1)checked="checked" @endif /><span class="check__box">@lang('custom::admin.Title')</span></label>
                    </li>

                    <li><label class="check --radio"  onclick="@this.changeSingleItem({{$item_f['id']}}, 'expanded_list', {{ $item_f['expanded_list'] == 1 ? 0 : 1}})">
                        <input class="check__input" type="checkbox" @if($item_f['expanded_list'] == 1)checked="checked" @endif /><span class="check__box">@lang('custom::admin.expanded_list')</span></label></li>
                    @if(isset($select_data['show_type']) AND $select_data['show_type']=='radio' OR isset($select_data['show_type']) AND $select_data['show_type']=='checkbox' OR $item_f['show_type']=='checkbox' OR $item_f['show_type']=='radio' )
                    <li><label class="check --radio"  onclick="@this.changeSingleItem({{$item_f['id']}}, 'search', {{ $item_f['search'] == 1 ? 0 : 1}})">
                        <input class="check__input" type="checkbox" @if($item_f['search'] == 1)checked="checked" @endif /><span class="check__box">@lang('custom::admin.Search window')</span></label></li>
                   {{-- <li><label class="check --radio"  onclick="@this.changeSingleItem({{$item_f['id']}}, 'search', {{ $item_f['search'] == 1 ? 0 : 1}})"><input class="check__input" type="checkbox" @if($item_f['search'] == 1)checked="checked" @endif /><span class="check__box">@lang('custom::admin.Search window')</span></label></li>--}}
                    @endif
                   @endif
                </ul>
            </td>
           {{-- <td>
                <div class="button-group">
                    <button class="button button-small button-icon ico_trash" title="@lang('custom::admin.Del')" type="button" onclick="@this.destroyDataFilterAttribute('{{$item_f['id']}}')"></button></div>
            </td>--}}
        </tr>
        @endif
        @endforeach
@else
                <tr>
                    <td class="text-center" style="display: table-cell;" colspan="7">
                @lang('custom::admin.No data available')

                    </td>

                </tr>
    @endif
    </tbody>
</table>

        @include('livewire.admin.includes.per-page-table')

