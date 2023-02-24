<div class="lk-widjet lk-widjet-new-user">
    <div class="lk-widjet__header">
        @php($counterText = $counter ? "+$counter" : '')
        <div class="lk-widjet__title">@lang('custom::site.new_customers') <span>{{$counterText}}</span></div>
        <a class="lk-widjet__more-btn"
           wire:click="flashCounter"
           href="{{route('manager.users.index')}}"><span
                class="ico_angel-r"></span></a>
    </div>
    <div class="lk-widjet__body">
        <ul class="new-user-list">
            @foreach($records as $user)
            <li class="new-user-list__item">
                <div class="new-user-list__box">
                    <div class="new-user-list__avatar"><img
                            src="{{$user->correctAvatar('/assets/img/avatar-3.png')}}" alt="{{$user->name}}"></div>
                    <div class="new-user-list__text">
                        <a class="new-user-list__desc" href="{{route('manager.users.index', ['user_id' => $user->id])}}">
                            <div class="new-user-list__name">{{$user->name}}</div>
                            <div class="new-user-list__company">{{$user->counterparty->name ?? ''}}</div>
                        </a>
                        @if($order = $user->orders->first())
                        <div class="new-user-list__info"><span
                                class="new-user-list__date">{{formatDate($order->created_at)}}</span><span
                                class="new-user-list__price text-lowercase">{{formatMoney($order->total, 0)}} @lang('custom::site.uah').</span>
                        </div>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
