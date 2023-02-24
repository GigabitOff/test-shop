<div class="lk-widjet lk-widjet-receivables">
    <div class="lk-widjet__parallax">
        <div class="lk-widjet__decor" data-depth="-0.2"><img
                src="/assets/img/widjet-receivables.svg" alt=""></div>
    </div>
    <div class="lk-widjet__header">
        @php
            $total = $totalCount ? "+$totalCount" : '';
        @endphp
        <div class="lk-widjet__title">@lang('custom::site.overdue') <span>{{$total}}</span></div>
        <a class="lk-widjet__more-btn" href="{{route('manager.debts')}}"><span
                class="ico_angel-r"></span></a>
    </div>
    <div class="lk-widjet__body">
        <ul class="receivables-widjet-list">
            @foreach($debtors as $debtor)
            <li class="receivables-widjet-list__item">
                <div class="receivables-widjet-list__box">
                        <div class="receivables-widjet-list__info">
                            <div class="receivables-widjet-list__company">{{$debtor->name}}</div>
                            <a class="receivables-widjet-list__phone"
                               href="tel:+">{{formatPhoneNumber($debtor->phone)}}</a>
                        </div>
                    <div class="receivables-widjet-list__price-info">
                        <div class="receivables-widjet-list__price">
                            <div class="lk-arrears-list__icon">
                                @php
                                    $percent = (int)abs($debtor->overdue_sum / $debtor->debt_sum * 100);
                                    $color = $percent <= 30 ? '#4285f4' : ($percent <= 60 ? '#FBBC05' : '#FF4D4D');
                                @endphp
                                <div class="chart chart-1" data-percent="{{$percent}}" data-bar-color="{{$color}}"></div>
                            </div>
{{--                            <span--}}
{{--                                class="icon"><img src="/assets/img/lk-arrears-1.svg"--}}
{{--                                                  alt=""></span>--}}
                            <span>{{formatMoney($debtor->overdue_sum, 0)}}<small class="text-lowercase">@lang('custom::site.uah')</small></span>
                        </div>
                        @php($days = numericCasesLang($debtor->overdue_days, 'custom::site.day'))
                        <div class="receivables-widjet-list__day">{{$debtor->overdue_days}} {{$days}}</div>
                    </div>
                    <div class="receivables-widjet-list__bottom"><a
                            class="receivables-widjet-list__edit"
                            href="{{route('manager.debts', ['counterparty_id' => $debtor->id])}}"><span
                                class="ico_edit"></span></a></div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
