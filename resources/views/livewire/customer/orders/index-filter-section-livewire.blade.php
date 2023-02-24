<div class="lk-page__submenu">
    <div class="submenu">
        <div class="submenu__title">{{__('custom::site.show')}}:</div>
        <button class="submenu__btn" type="button">
            <a class="lk-submenu__link" href="javascript:void(0);">
                <span class="lk-submenu__title">{{$title}}</span>
                <span class="lk-submenu__number">{{$count}}</span>
            </a>
        </button>
        <div class="submenu__box">
            <ul class="lk-submenu">
                <li class="lk-submenu__item">
                    <a class="lk-submenu__link"
                       href="javascript:void(0);" wire:click="setFilter(0)">
                        <span class="lk-submenu__title">@lang('custom::site.all')</span>
                        <span class="lk-submenu__number">{{$countAll}}</span>
                    </a>
                </li>
                @foreach($statuses as $statusItem)
                    <li class="lk-submenu__item">
                        <a class="lk-submenu__link" href="javascript:void(0);"
                           wire:click="setFilter({{$statusItem->id}})">
                            <span class="lk-submenu__title">{{$statusItem->title}}</span>
                            <span class="lk-submenu__number">{{$statusItem->ordersCount}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
