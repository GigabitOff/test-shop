<table>
  <thead>
    <tr>
      <th>@lang('custom::site.date')</th>
      <th>@lang('custom::site.date_shipment')</th>
      <th data-breakpoints="xs">{{ auth()->user()->hasRole('simple') ? __('custom::site.price') : __('custom::site.rcc_opt')}}</th>
      <th data-breakpoints="xs">@lang('custom::site.delivery')</th>
      <th data-breakpoints="xs">@lang('custom::site.status')</th>
      {{--<th data-breakpoints="xs sm md">@lang('custom::site.returning')</th>--}}
      <th data-breakpoints="xs sm md">@lang('custom::site.invoice')</th>
      <th data-breakpoints="xs sm md">@lang('custom::site.invoice_note')</th>
      {{--<th data-breakpoints="xs">@lang('custom::site.bonuses')</th>--}}
    </tr>
  </thead>
  <tbody>
  @foreach($orders as $order)
    <tr>
      <td><a href="{{route('customer.orders.show', ['order' => $order->id])}}">№ {{$order->id}}</a><span class="small">@lang('custom::site.from') {{formatDate($order->created_at)}}</span></td>
      <td><span>@if($order->date_delivery) {{formatDate($order->date_delivery)}} @endif</span></td>
      <td><span class="small">{{$order->total_quantity}} @lang('custom::site.Goods')</span><span class="big">{{$order->discounts ?? '0'}} @lang('custom::site.uah')</span><span class="small">{{formatMoney($order->total)}} @lang('custom::site.uah').</span></td>
      <td>
      @if($order->deliveryIcon)
      <img src="{{$order->deliveryIcon}}" alt="image">
      @endif
      </td>
      <td>
        <div class="status --status-{{$order->status ? $order->status->id : ''}}"><span class="circle"></span><span>{{$order->status ? $order->status->name : ''}}</span></div>
      </td>
      {{--<td>
        <div class="return">
          <div><i class="ico_checkmark"></i></div>
          <div><span>@lang('custom::site.confirmed')</span><span class="small">23 шт / 27 шт</span></div>
        </div>
      </td>--}}
        @foreach($documents as $document)
         @if($document->id == $order->id && $document->filename)
      <td>
            @if($document->type == App\Models\Document::TYPE_INVOICE AND $order->counterparty)
            <div class="d-flex flex-column">
                {{ $order->counterparty->name}}
                <a class="download__bill" href="/{{$document->path}}">@lang('custom::site.download_waybill')</a></div>
        @else
         <a href="/{{$document->path}}" targey="_blank"><img src="/assets/img/pdf.svg" alt="pdf"></a>
        @endif

       </td>
         @endif
        @endforeach
      @php($bonuses = $order->bonus_earned ? formatMoney($order->bonus_earned) : '')
      {{--<td><span>{{$bonuses}}</span></td>--}}

    </tr>
  @endforeach
  </tbody>
</table>
