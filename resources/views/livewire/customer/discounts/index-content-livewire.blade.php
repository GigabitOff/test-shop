<div class="lk-page__content">
    <h1 class="lk-page__title">@lang('custom::site.discounts')</h1>

    @if($ordersInfo['total'])
        <div class="lk-page__subtitle">@lang('custom::site.current_orders_total')
                <b class="text-lowercase">{{formatNbsp(formatMoney($ordersInfo['total'], 0))}} @lang('custom::site.uah')</b>
                <span>{{formatDate($ordersInfo['oldest_at'])}}-{{formatDate($ordersInfo['newest_at'])}}</span>
        </div>
    @endif
    <div class="row g-5 mb-5">
        <div class="col-xxl-5 col-12">
            <div class="discount-widjet">
                <div class="discount-widjet__head">
                    <div>
                        <h3>@lang('custom::site.your_bonus')</h3>
                        <div class="button-info --bonus">
                            <button class="button-info__button ico_info" type="button"></button>
                            <div class="button-info__dropdown">
                                <div class="button-info__content">
                                    <p>{{$bonusPopup}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="discount-widjet__body">
                    <ul class="discount-widjet__list">
                        <li>
                            <div><span>@lang('custom::site.accrued')</span></div>
                            <div>
                                <img src="/assets/img/ico-progress-1.svg" alt="icon">
                                <strong
                                    class="text-lowercase">{{formatNbsp(formatMoney($bonusEarned, 0))}} @lang('custom::site.uah')</strong>
                            </div>
                        </li>
                        <li>
                            <div><span>@lang('custom::site.written_off')</span></div>
                            <div><img src="/assets/img/ico-progress-2.svg" alt="icon">
                                <strong
                                    class="text-lowercase">{{formatNbsp(formatMoney($bonusUsed, 0))}} @lang('custom::site.uah')</strong>
                            </div>
                        </li>
                        <li>
                            <div><span>@lang('custom::site.remainder')</span></div>
                            <div><img src="/assets/img/ico-progress-3.svg" alt="icon">
                                <strong
                                    class="text-lowercase">{{formatNbsp(formatMoney($bonusAvailable, 0))}} @lang('custom::site.uah')</strong>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-6">
            <div class="discount-widjet">
                <div class="discount-widjet__head">
                    <div>
                        <h3>@lang('custom::site.cashback')</h3>
                    </div>
                </div>
                <div class="discount-widjet__body">
                    <ul class="discount-widjet__list">
                        <li>
                            <div><span>@lang('custom::site.accrued')</span></div>
                            <div>
                                <img src="/assets/img/ico-chart.svg" alt="icon">
                                <strong
                                    class="text-lowercase">{{formatNbsp(formatMoney($cashback, 0))}} @lang('custom::site.uah')</strong>
                            </div>
                        </li>
                        <li>
                            <div><span>@lang('custom::site.use_to')</span></div>
                            <div><span>22.02.22 ??</span></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-6">
            <div class="discount-widjet">
                <div class="discount-widjet__head">
                    <div>
                        <h3>@lang('custom::site.discounts')<span>+32 ??</span></h3>
                    </div>
                    <div>
                        <a class="lk-widjet__more"
{{--                           href="#modal-discont" --}}
{{--                           data-toggle="modal"--}}
                            onclick="document.discountsHandlers.showDiscountProductListPopup()"
                        >
                            <i class="ico_angle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="discount-widjet__body">
                    <ul class="discount-widjet__list discount-widjet__list--row">
                        <li>
                            <div><span>@lang('custom::site.category')</span></div>
                            <div><img src="/assets/img/ico-fire.svg" alt="icon">
                                <strong>27%</strong>
                            </div>
                        </li>
                        <li>
                            <div><span>@lang('custom::site.product')</span></div>
                            <div><img src="/assets/img/ico-fire.svg" alt="icon">
                                <strong>40%</strong>
                            </div>
                        </li>
                        <li>
                            <div><span>@lang('custom::site.product')</span></div>
                            <div><img src="/assets/img/ico-fire.svg" alt="icon">
                                <strong>30%</strong>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <h1 class="lk-page__title">@lang('custom::site.personal_offer')</h1>
    <div class="lk-page__table">
        <div id="footable-content"
             class="footable-content @if($this->isNeedRevalidateFootable()) footable-revalidate @endif"
             style="display: none">
            @include('livewire.customer.discounts.index-footable-render')
        </div>
        <table wire:ignore id="footable-holder" class="ftable"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>

    </div>
    <div class="lk-page__table-after">
        <div></div>
        <div>
            @include('livewire.includes.per-page-footable', ['paginator' => $products])
        </div>

    </div>

</div>

@push('custom-scripts')
    <script>
        document.discountsHandlers = {
            showDiscountProductListPopup: () => {
                Livewire.emit('eventShowDialogMessage', {
                    'title': '@lang("custom::site.discounts")',
                    'message': 'В работе.',
                })
            }
        }
        //# sourceURL=discounts.index-content-livewire.js
    </script>
@endpush
