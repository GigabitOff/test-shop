<table>
    <thead>
    <tr>
        <th>№/@lang('custom::admin.date')</th>
        <th>@lang('custom::admin.time_order')</th>
        <th data-breakpoints="xs">@lang('custom::admin.payment')</th>
        <th data-breakpoints="xs">@lang('custom::admin.summ')</th>
        <th data-breakpoints="xs">@lang('custom::admin.Manager')</th>
        <th data-breakpoints="xs">@lang('custom::admin.Сustomer')</th>
        <th data-breakpoints="xs sm md">@lang('custom::admin.Status')</th>
        <th data-breakpoints="xs sm md">@lang('custom::admin.Review')</th>
        <th data-breakpoints="xs sm md"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data_paginate as $item)
        <tr>
                    <td><a class="accent" href="{{ route('admin.'.$nameLive.'.show', $item->id)}}">№{{ $item->id }}</a><span class="order-info">@lang('custom::admin.from') {{ formatDate($item->created_at,'d.m.Y')}}</span></td>
                    <td>{{ formatDate($item->created_at,'H:i')}}</td>
                    <td>{{ $item->paymentType}}</td>
                    <td>{{formatMoney($item->total)}} @lang('custom::site.uah')<spam class="order-info">{{ count($item->products)}} @lang('custom::admin.tovars')</spam>
                    </td>
                    <td><span class="nowrap">{{ $item->manager ? $item->manager->name : ''}}</span></td>
                    <td><span class="nowrap">{{ $item->customer->name}}</span><a class="order-customer-phone" href="tel:+{{ $item->customer->phone}}">+{{ $item->customer->phone}} </a></td>
                    <td>
                      <div class="status-button status-button-{{$item->status_id }}">{{ $item->status->name }}{{-- isset($statusList[$item->status_id]) ? $statusList[$item->status_id]['name'] : '' --}}</div>
                    </td>
                    <td><a class="button button-small button-icon ico_reviwe" href="#"></a></td>
                    <td> <a class="button button-small button-icon ico_edit" href="{{ route('admin.'.$nameLive.'.show', $item->id)}}"></a></td>
                  </tr>
    {{--<tr>
            <td class="w-1">{{$item->id}}</td>
            <td class="w-100">
                <div class="box-services">
                    <a href="{{ route('admin.product.edit', $item->id)}}">
                        {{$item->name}}
                    </a>
                </div>
            </td>

            <td class="text-center">
                <span id="active{{$item->id}}" class="icon-status ico_checkmark mt-1 js-fee @if($mainCat == $item->id) is-active @endif " onclick="showMainCat('active{{$item->id}}')"
                        @click="$wire.setMainCategory({{$item->id}})"
                    ></span>
            </td>

            <td class="text-end w-1">
                <button class="button button-small button-icon ico_trash js-free"
                        @click="$wire.removeCategory({{$item->id}})"
                ></button>
            </td>

        </tr>--}}
    @endforeach

    </tbody>
</table>
