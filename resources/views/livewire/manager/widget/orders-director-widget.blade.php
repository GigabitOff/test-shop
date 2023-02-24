<div class="lk-widjet lk-widjet-orders lk-widjet-leader-orders">
    <div class="lk-widjet__parallax">
        <div class="lk-widjet__decor" data-depth="0.2"><img src="/assets/img/index-orders.svg" alt=""></div>
    </div>
    <div>
        <div class="lk-widjet__title">@lang('custom::site.new_plural')<div class="text-lowercase">@lang('custom::site.orders')</div></div>
        <a class="lk-widjet__more-btn" href="{{route('manager.orders.index')}}"><span class="ico_angel-r"></span></a>
    </div>
    <div>
        <ul class="lk-new-orders-list">
            @forelse($orders as $order)
            <li class="lk-new-orders-list__item">
                <div class="lk-new-orders-list__info">
                    <a class="lk-new-orders-list__name" href="{{route('manager.orders.show', ['order'=>$order->id])}}">{{$order->customer->name}}</a>
                    <div class="lk-new-orders-list__bottom">
                        <div class="lk-new-orders-list__date">{{formatDate($order->created_at)}}</div>
                        <div class="lk-new-orders-list__price">{{formatMoney($order->total)}} @lang('custom::site.uah')</div>
                    </div>
                </div>
                    @if($order->isPaid())
                <div class="lk-new-orders-list__status success">
                        <span>@lang('custom::site.paid')</span>
                </div>
                    @else
                <div class="lk-new-orders-list__status cancel">
                        <span>@lang('custom::site.not_paid')</span>
                </div>
                    @endif
            </li>
            @empty
                <li class="lk-orders-list__item">
                    <div>{{__('custom::site.no_orders')}}</div>
                </li>
            @endforelse
        </ul>
    </div>
</div>
