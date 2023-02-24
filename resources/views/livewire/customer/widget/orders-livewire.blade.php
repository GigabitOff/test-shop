<div class="col-xl-6" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500">
  <div class="lk-widjet --orders">
    <div class="lk-widjet__head">
      <h3 class="lk-widjet__title">{{__('custom::site.orders')}}<span>+{{$orders->count()}}</span></h3><a class="lk-widjet__more" href="{{route('customer.orders.index')}}"><i class="ico_angle-right"></i></a>
    </div>
    <div class="lk-widjet__body">
      <ul class="widjet-orders-list">
      @forelse($orders as $order)
        <li class="widjet-orders-list__item">
          <div class="widjet-orders-list__item-top">
            <div><a class="widjet-orders-list__item-numb" href="{{route('customer.orders.show',['order'=> $order->id])}}">
                <div class="status --status-1"><span class="circle"></span><span>№ {{$order->id}}</span></div>
              </a>
              <div class="widjet-orders-list__item-date">{{__('custom::site.from')}} {{formatDate($order->created_at)}}</div>
            </div>
            <div>
              <div class="widjet-orders-list__item-price">{{formatMoney($order->total)}} {{__('custom::site.uah')}}.</div>
            </div>
          </div>
          <div class="widjet-orders-list__item-bottom">
            <div class="widjet-orders-list__item-status">{{$order->status->name}}</div>
          </div>
        </li>
        @empty
          <li class="lk-orders-list__item">
              <div>{{__('custom::site.no_orders')}}</div>
          </li>
        @endforelse
      </ul>
    </div>
  </div>
</div>