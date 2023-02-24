<div>
    {{-- Filter Categories in admin --}}
@if(isset($data_paginate) AND count($data_paginate)>0)

    <table class="js-table js-table_new footable">
    <thead>
        <tr>
            <th style="display: table-cell;">@lang('custom::admin.Name')</th>
            {{--<th data-breakpoints="xs">@lang('custom::admin.Display')</th>--}}
            <th class="text-center" style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Order')</th>
            {{--<th data-breakpoints="xs">@lang('custom::admin.For desktop')</th>
            <th data-breakpoints="xs">@lang('custom::admin.For mobile')</th>
            --}}<th class="text-center" style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Status')</th>
            {{--<th class="w-1" data-breakpoints="xs"></th>--}}
        </tr>
     </thead>
    <tbody >
        @foreach ($data_paginate as $key=>$item)
        <tr >
            <td style="display: table-cell;"><span>
                @if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->name)){{$item->translate(session('lang'))->name}}@else{{config('app.fallback_locale') }}@endif
            </span></td>
                {{--<td><span>Радиобаттон</span></td>--}}
            <td class="text-center" style="display: table-cell;">

                    <input class="form-control form-xs" type="number" placeholder="1" value="{{ $item->filter_order}}" onchange="changeOrderCustom({{$item->id}},this.value, this,{{(count($allCategories))}}); @this.changeOrderCustom({{$item->id}}, this.value);">
            </td>
            {{--<td><label class="check --radio">
                <input class="check__input" type="checkbox" @if($item->filter_for_desctop==1)checked="checked"@endif onclick="@this.changeSingleDataItem({{$item->id}}, 'filter_for_desctop', {{$item->filter_for_desctop==1 ? 0 :1}})" />
                <span class="check__box">@lang('custom::admin.Show item')</span></label></td>
            <td><label class="check --radio">
                <input class="check__input" type="checkbox" @if($item->filter_for_mobile==1)checked="checked"@endif onclick="@this.changeSingleDataItem({{$item->id}}, 'filter_for_mobile', {{$item->filter_for_mobile==1 ? 0 :1}})" />
                <span class="check__box">@lang('custom::admin.Show item')</span></label></td>
            --}}<td class="text-center" style="display: table-cell;"><label class="check eye">
                <input class="check__input" type="checkbox" @if($item->filter_status==0)checked="checked"@endif onclick="@this.changeSingleDataItem({{$item->id}}, 'filter_status', {{$item->filter_status==1 ? 0 :1}})" />
                <span class="check__box"></span></label></td>
            {{--<td class="text-end">
                <div class="button-group flex-row">
                    <div></div>
                    <div><button class="button button-small button-icon ico_trash" type="button" data-bs-toggle="modal" data-bs-target="#m-delete"></button></div>
                  </div>
            </td>--}}
        </tr>
        @endforeach

        </tbody>
    </table>
    @include('livewire.admin.includes.per-page-table')

@endif

<script>
    function changeOrderCustom(id_s, values, input,count_it){

        if(values == 0)
            {
                values = 1;
                input.value = values;
            }


            if(values>count_it)
            {
                values = count_it;
                input.value = values;
             //  alert(input.value);
            }




    }
</script>
</div>
