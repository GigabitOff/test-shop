  <div class="lk-widjet --bonus">
    <div class="lk-widjet__head">
      <h3 class="lk-widjet__title">@lang('custom::site.your') @lang('custom::site.bonus')
      <i class="ico_info"></i></h3>
      <a class="lk-widjet__more" href="/lk-bonus.html"><i class="ico_angle-right"></i></a>
    </div>
    <div class="lk-widjet__body">
      <div class="widjet-bonus-box">
        <div class="widjet-bonus-total-pay"><img src="/assets/img/bonus-total-pay.svg" alt="image">
          <div><span>@lang('custom::site.current_orders_total')</span><strong>{{formatMoney($ordersTotal)}} @lang('custom::site.uah')</strong></div>
        </div>
        <div class="widjet-bonus-value">
          <div class="widjet-bonus-value__box"><span>@lang('custom::site.my_bonus') /@lang('custom::site.uah') </span><strong>{{formatMoney($customer->bonus_available)}}</strong><img src="/assets/img/time_progress.svg" alt="image"></div>
        </div>
      </div>
    </div>
  </div>