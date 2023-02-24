<table>
    <thead>
    <tr>
        <th>№ / @lang('custom::site.date')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.date_shipment')</th>
        <th class="text-center">@lang('custom::site.payment')</th>
        <th class="text-center">@lang('custom::site.sum')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.company')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.client')</th>
        <th class="text-xl-center" data-breakpoints="xs sm md">@lang('custom::site.status')</th>
        <th class="text-xl-center" data-breakpoints="xs sm md">@lang('custom::site.delivery_method')</th>
        <th data-breakpoints="xs sm md"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td><a class="cell-number"
                   href="{{route('manager.orders.show', [$id=$order->id])}}">№ {{$order->id}}</a><span
                    class="cell-date">@lang('custom::site.from') {{formatDate($order->created_at)}}</span></td>
            <td class="text-right text-md-center"><span>{{formatDate($order->date_delivery)}}</span></td>
            <td class="text-center">
                <span class="max-width"
                      title="{{$order->paymentType->name ?? ''}}">{{$order->paymentType->name ?? ''}}</span>
            </td>
            <td class="text-center">
                <div class="d-flex flex-column">
                    <span class="cell-price max-width text-lowercase"
                          title="{{formatMoney($order->total)}} @lang('custom::site.uah').">{{formatMoney($order->total)}} @lang('custom::site.uah').</span>
                    @php($products = numericCasesLang($order->products->count(), 'custom::site.product'))
                    <span class="cell-size max-width text-lowercase"
                          title="{{$order->products->count()}} {{$products}}">{{$order->products->count()}} {{$products}}</span>
                </div>
            </td>
            <td class="text-right text-md-center">
                @if($order->contract)
                    <span class="max-width"
                          title="{{$order->contract->counterparty->name}}">{{$order->contract->counterparty->name}}</span>
                @endif
            </td>
            <td class="text-right text-md-center">
                <span class="cell-user max-width" title="{{$order->customer->name}}">{{$order->customer->name}}</span>
                <a class="cell-phone" href="tel:+{{$order->customer->phone}}">
                    {{formatPhoneNumber($order->customer->phone)}}</a>
            </td>
            <td class="text-right text-md-center">
                <span title="{{$order->status ? $order->status->name : ''}}"
                      class="max-width">{{$order->status ? $order->status->name : ''}}</span></td>
            <td class="text-right text-md-center">
                @if($order->deliveryAddress)
                    <span title="{{$order->deliveryAddress->deliveryType->name}}"
                          class="max-width">{{$order->deliveryAddress->deliveryType->name}}</span>
                @endif
            </td>
            <td class="text-right text-lg-center">
                <div class="action-group">
                    <div class="action-group-btn"><span class="ico_submenu"></span></div>
                    <div class="action-group-drop">
                        <ul class="action-group-list">
                            <li><a href="{{route('manager.orders.show', [$id=$order->id])}}"><span
                                        class="ico_edit"></span></a></li>
                            <li>
                                <button type="button" class="js-copy"
                                        onclick="Livewire.emit('eventOrderReplicate', {{$order->id}})"
                                        title="@lang('custom::site.copy')">
                                    <span class="ico_copy"></span>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="js-del"
                                        data-toggle="modal" data-target="#modal-order-delete-confirm"
                                        onclick="document.tm.orderDeleteId = {{$order->id}}"
                                        title="@lang('custom::site.delete')">
                                    <span class="ico_delete"></span>
                                </button>
                            </li>
                            <li>
                                <button class="js-hide-drop" type="button"><span class="ico_close"></span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
