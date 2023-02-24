<table>
    <thead>
    <tr>
        <th>№</th>
        <th class="text-md-center">@lang('custom::site.contract')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.order') №</th>
        <th class="text-md-center">@lang('custom::site.sum')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.payment_type')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.date_shipment')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.postponement_date_end')</th>
{{--        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.to_pay')</th>--}}
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.overdue_sum')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
    <tr>
        <td class="text-md-center"><a href="{{route('customer.orders.show', ['order' => $order->id])}}">{{$loop->index+1}}</a></td>
        <td class="text-md-center"><span>{{$order->contract->registry_no}}</span></td>
        <td class="text-md-center"><span>{{$order->id}}</span></td>
        <td class="text-md-center"><strong class="text-lowercase">{{formatMoney($order->total)}} @lang('custom::site.uah')</strong></td>
        <td class="text-md-center"><span>{{$order->paymentType->name}}</span></td>
        <td class="text-md-center"><span>{{formatDate($order->departure_at)}}</span></td>
        <td class="text-md-center"><strong>{{formatDate($order->debt_end_at)}}</strong></td>
{{--        <td class="text-md-center"><a class="cell-btn"--}}
{{--               onclick="document.receivables.onPayOrder({{$order->id}})"--}}
{{--               href="javascript:void(0);"><span class="ico_credit-card"></span></a></td>--}}
        <td class="text-md-center"><strong class="text-lowercase">{{formatMoney($order->debt_sum)}} @lang('custom::site.uah')</strong></td>
    </tr>
    @endforeach
    </tbody>
</table>
