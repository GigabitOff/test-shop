<div class="lk-widjet lk-widjet-orders">
    <div class="lk-widjet__parallax">
        <div class="lk-widjet__decor" data-depth="0.2"><img
                src="/assets/img/index-orders.svg" alt=""></div>
    </div>
    <div>
        <div class="lk-widjet__title">@lang('custom::site.orders') <span>+{{$counter}}</span></div>
        @if($orders)
            <a class="lk-widjet__more-btn" href="{{route('manager.orders.index')}}"><span
                    class="ico_angel-r"></span></a>
        @endif
    </div>
    <div>
        <ul class="lk-orders-list">
            @forelse($orders as $order)
                <li class="lk-orders-list__item">
                    <div>
                        <div class="lk-orders-list__info"><span
                                class="lk-orders-list__order {{$this->getOrderStatusStyle($order)}}"><a
                                    href="{{route('manager.orders.show', ['order'=>$order->id])}}">№ {{$order->id}}</a></span><span>@lang('custom::site.from') {{formatDate($order->created_at)}}</span>
                        </div>
                        <div class="lk-orders-list__status"><span>{{$order->status ? $order->status->name : ''}}</span>
                        </div>
                    </div>
                    <div>
                        <div class="lk-orders-list__price">
                            <span>{{formatMoney($order->total)}} @lang('custom::site.uah').</span></div>
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
