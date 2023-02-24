<div class="col-xl-6" data-aos="fade-right" data-aos-delay="400" data-aos-duration="500">
  <div class="lk-widjet --arrears">
    <div class="lk-widjet__head">
      <h3 class="lk-widjet__title">@lang('custom::site.receivables')<span>@lang('custom::site.update')</span></h3><a class="lk-widjet__more" href="/lk-receivables.html"><i class="ico_angle-right"></i></a>
    </div>
    <div class="lk-widjet__body">
      <div class="widjet-arrears-box">
        <div class="widjet-arrears-card">
          <div class="widjet-arrears-card__head">
            <div class="widjet-arrears-card__numb">0000/000</div>
            <div class="widjet-arrears-card__date">{{formatDate($counterparty->created_at)}}</div>
          </div>
          <div class="widjet-arrears-card__body">
            <div class="widjet-arrears-card__img"><img src="/assets/img/widjet-arrears.svg" alt="image">
              <div class="lk-widjet__parallax widjet-arrears-card__parallax">
                <div class="widjet-arrears-card__decor" data-depth="-0.5"><img src="/assets/img/widjet-arrears.svg" alt=""></div>
              </div>
            </div>
            <div class="widjet-arrears-card__desc">
              <div class="widjet-arrears-card__label">@lang('custom::site.credit limit sum') / @lang('custom::site.uah')</div>
              <div class="widjet-arrears-card__value">{{formatMoney($totals['sumDebtSum'] ?? 0, 0)}}</div>
               @php($days = numericCasesLang($debtor->overdue_days, 'custom::site.day'))
              <div class="widjet-arrears-card__days"><span>@lang('custom::site.postponement')</span><b>{{$debtor->overdue_days ?? 0}} {{$days}}</b></div>
            </div>
          </div>
        </div>
        <ul class="widjet-arrears-list">
          <li class="widjet-arrears-list__item">
            <div class="widjet-arrears-list__icon"><img src="/assets/img/widjet-arrears-list-1.svg" alt="image"></div>
            <div class="widjet-arrears-list__desc"><span>@lang('custom::site.account_remainder')</span><b>{{formatMoney($totals['totalRemainder'] ?? 0, 0)}} @lang('custom::site.uah')</b></div>
          </li>
          <li class="widjet-arrears-list__item">
            <div class="widjet-arrears-list__icon"><img src="/assets/img/widjet-arrears-list-2.svg" alt="image"></div>
            <div class="widjet-arrears-list__desc"><span>@lang('custom::site.debt sum')</span>
            <b>{{formatMoney($totals['sumDebtSum'] ?? 0, 0)}} @lang('custom::site.uah')</b></div>
          </li>
          <li class="widjet-arrears-list__item">
            <div class="widjet-arrears-list__icon"><img src="/assets/img/widjet-arrears-list-3.svg" alt="image"></div>
            <div class="widjet-arrears-list__desc"><span>@lang('custom::site.overdue_sum')</span><b>{{formatMoney($debtor->overdue_sum ?? 0, 0)}} @lang('custom::site.uah')</b></div>
          </li>
          <li class="widjet-arrears-list__item">
            <div class="widjet-arrears-list__icon"><img src="/assets/img/widjet-arrears-list-4.svg" alt="image"></div>
            @php($days = numericCasesLang($debtor->overdue_days, 'custom::site.day'))
            <div class="widjet-arrears-list__desc"><span>{{$debtor->overdue_days ?? 0}} @lang('custom::site.overdue')</span><b>{{$debtor->overdue_days ?? 0}}</b></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>