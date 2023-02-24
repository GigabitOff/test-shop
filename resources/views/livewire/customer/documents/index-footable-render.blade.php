<table>
  <thead>
    <tr>
      <th>№ / @lang('custom::site.date')</th>
      <th>@lang('custom::site.date_shipment')</th>
      <th data-breakpoints="xs">@lang('custom::site.order_sum') 
      / @lang('custom::site.discounts') / @lang('custom::site.total all')</th>
      <th data-breakpoints="xs">@lang('custom::site.delivery_method')</th>
      <th data-breakpoints="xs">@lang('custom::site.Status')</th>
      <th class="w-1" data-breakpoints="xs sm md"> @lang('custom::site.create')</th>
    </tr>
  </thead>
  <tbody>
  @foreach($records as $order)
    <tr>
      <td><a href="{{route('customer.orders.show', ['order' => $order])}}">№ {{$order->id}}</a>
      <span class="small">@lang('custom::site.from') {{formatDate($order->created_at)}}</span></td>
      <td><span>{{formatDate($order->date_delivery)}}</span></td>
      @php($textProducts = numericCasesLang($order->total_quantity, 'custom::site.product') )
      <td><span class="small">{{$order->total_quantity}} {{$textProducts}}</span><span class="big">{{$order->discounts ?? '0'}} @lang('custom::site.uah')</span><span class="small">{{formatMoney($order->total)}} @lang('custom::site.uah')</span></td>
      <td>
      @if($order->deliveryIcon)
      <img src="/assets/img/{{$order->deliveryIcon}}" alt="image">
      @endif
      </td>
      <td>
        <div class="return">
          <div class="--success"><i class="ico_checkmark"></i></div>
          <div><span>@lang('custom::site.confirmed')</span><span class="small">23 шт / 27 шт</span></div>
        </div>
      </td>
      <td class="w-1">
        <div class="table-button-group"><a class="button-outline button-small" 
        href="{{route('customer.orders.reverse-invoice.create', ['order' => $order->id])}}">
        @lang('custom::site.returning')</a>
        <a class="button-outline button-small" 
        href="{{route('customer.orders.complaint.create', ['order' => $order->id])}}">
        @lang('custom::site.complaint')</a></div>
      </td>
    </tr>
    
  @endforeach  
  </tbody>
</table>