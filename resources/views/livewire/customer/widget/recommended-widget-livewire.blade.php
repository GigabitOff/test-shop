  <div class="lk-widjet --recomend-orders">
    <div class="lk-widjet__head">
      <h3 class="lk-widjet__title">@lang('custom::site.recommended') @lang('custom::site.order')</h3><a class="lk-widjet__more" href="{{route('customer.discounts')}}"><i class="ico_angle-right"></i></a>
    </div>
    <div class="lk-widjet__body">
      <div class="recomend-orders">
   @foreach($recomendedOrders as $order)
      @foreach($order->products as $product)
        <div class="recomend-order-item"><a class="recomend-order-item__link" href="{{ route('products.show', [$product->slug])}}">
            <h4 class="recomend-order-item__title">
          @foreach ($product->translations as $item_d)
            @if($item_d->locale == app()->getLocale())
              {{$product->name}}
            @endif
          @endforeach
            </h4><span class="recomend-order-item__numb">№{{$product->articul}}</span>
          </a></div>
      @endforeach
    @endforeach
      </div>
    </div>
  </div>

            