<table>
    <thead>
    <tr>
        <th>№ / @lang('custom::site.date')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.date_shipment')</th>
        <th class="text-md-center">@lang('custom::site.order_sum')</th>
        <th class="text-xl-center" data-breakpoints="xs sm md">@lang('custom::site.delivery_method')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.payment')</th>
        <th class="text-xl-center" data-breakpoints="xs">@lang('custom::site.invoice_note')</th>
        <th class="text-xl-center" data-breakpoints="xs sm md">@lang('custom::site.create')</th>

    </tr>
    </thead>
    <tbody>
    @foreach($records as $order)
        <tr>
            <td>
                <a class="cell-number" href="{{route('customer.orders.show', ['order' => $order])}}">№ {{$order->id}}</a>
                <span class="cell-date">@lang('custom::site.from') {{formatDate($order->created_at)}}</span>
            </td>
            <td class="text-md-center"><span>{{formatDate($order->date_delivery)}}</span></td>
            <td class="text-md-center">
                <span class="cell-price">{{formatMoney($order->total)}} @lang('custom::site.uah').</span>
                @php($textProducts = numericCasesLang($order->total_quantity, 'custom::site.product') )
                <span class="cell-size text-lowercase">{{$order->total_quantity}} {{$textProducts}}</span>
            </td>
            <td class="text-xl-center">
                @if($order->deliveryIcon)
                    <img src="/assets/img/{{$order->deliveryIcon}}" alt="image"/>
                @endif
            </td>
            <td class="text-md-center">
                @php($invoice = $order->documentInvoices->first())
                @if($invoice && $invoice->path)
                    <a class="cell-btn" href="{{$invoice->fileUrl}}" target="_blank">
                        <span class="ico_downloads"></span><span>@lang('custom::site.invoice')</span></a>
                @else
                    <span>{{$order->paymentType->name}}</span>
                @endif
            </td>
            <td class="text-md-center">
                @php($waybill = $order->documentWaybills->first())
                @if($waybill && $waybill->path)
                    <a class="cell-btn" href="{{$waybill->fileUrl}}" target="_blank">
                        <span class="ico_downloads"></span>
                    </a>
                    @if($waybill->isDocumentStatusApproved())
                        <span class="cell-signed">@lang('custom::site.signed_she')</span>
                    @else
                        <span class="cell-no-signed">@lang('custom::site.not_signed_she')</span>
                    @endif
                @endif
            </td>
            <td>
                <div class="cell-row">
                    <a class="cell-btn"
                       href="{{route('manager.orders.reverse-invoice.create', ['order' => $order->id])}}">@lang('custom::site.returning')</a>
                    <a class="cell-btn"
                       href="{{route('manager.orders.complaint.create', ['order' => $order->id])}}">@lang('custom::site.complaint')</a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
