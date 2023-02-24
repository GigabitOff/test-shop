<div>
    <div class="lk-table-slider">
        <h3 class="lk-table-slider__title">@lang('custom::site.products_added')</h3>
        <div id="slides-house" class="slides-house" style="display: none;" data-house="{{$swiper}}"></div>
        <div class="js-creat-order-slider creat-order-slider" wire:ignore>
            <div class="swiper-container">
                @include('livewire.customer.orders.create-swiper-render', ['products' => $products])
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </div>
    <div class="lk-table-footer">
        <div class="lk-table-footer-left-row">
            <div class="lk-table-total">
                <div class="lk-table-total__item">
                    <div class="lk-table-total__title">@lang('custom::site.total_sum')</div>
                    <div class="lk-table-total__value">
                        <span class="lk-table-total__sum text-lowercase">{{formatMoney(cart()->totalCost())}} @lang('custom::site.uah').</span>
                    </div>
                </div>
                <div class="lk-table-total__item">
                    <div class="lk-table-total__title"></div>
                    <div class="lk-table-total__value">
                        @php($textProducts = numericCasesLang(cart()->totalQuantity(), 'custom::site.product') )
                        <span class="lk-table-total__col">{{cart()->totalQuantity()}} <span class="text-lowercase">{{$textProducts}}</span></span>
                        <span class="lk-table-total__weight">{{formatMoney($totals['weight'])}} @lang('custom::site.kg') /
                            {{formatMoney($totals['volume'])}} @lang('custom::site.m3')</span>
                    </div>
                </div>
{{--                <div class="lk-table-total__item">--}}
{{--                    <div class="lk-table-total__title">@lang('custom::site.estimated_delivery_date')</div>--}}
{{--                    <div class="lk-table-total__value"><span class="lk-table-total__date">08.12.2020</span></div>--}}
{{--                </div>--}}
            </div>
            <div class="lk-table-btns">
                <a class="button button-primary"
                   href="{{route('manager.cart')}}">@lang('custom::site.to_order')</a>
            </div>
        </div>
        <div></div>
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            // Обновляем swiper-slider без перезагрузки.
            Livewire.hook('element.updated', (el, component) => {
                if (el.classList.contains('slides-house')) {
                    const house = $(el).attr('data-house');
                    const $newest = $(house).find('.swiper-slide');
                    const $exist = $('.swiper-container .swiper-slide');

                    // собираем id товаров которые уже есть в слайдере.
                    const existIds = $exist.map((i, el) => {
                        return $(el).find('.product-card').attr('data-id');
                    }).toArray();
                    // собираем id товаров которые есть в обновлении.
                    const newestIds = $newest.map((i, el) => {
                        return $(el).find('.product-card').attr('data-id');
                    }).toArray();

                    // добавляем слайды отсутствующие в слайдере.
                    $newest.each((i, el) => {
                        const id = $(el).find('.product-card').attr('data-id');
                        if (!existIds.includes(id)) {
                            document.creatOrderSlider.appendSlide(el);
                        }
                    })
                    // Удаляем слайды отсутствующие в обновлении.
                    $exist.each((i, el) => {
                        const id = $(el).find('.product-card').attr('data-id');
                        if (!newestIds.includes(id)) {
                            $(el).find('.product-card').fadeOut('300');
                            setTimeout(() => document.creatOrderSlider.removeSlide(i), 400);
                        }
                    })
                    // Обновляем количество для всех слайдов.
                    // $newest.each((i, el) => {
                    //     const id = $(el).find('.product-card').attr('data-id');
                    //     if (existIds.includes(id) && !$(el).hasClass('freeze')) {
                    //         const qty = $(el).find('.product-card input').val();
                    //         $exist.find(`.product-${id} input`).val(qty)
                    //     }
                    // })
                }
            })

            // Обновляем input-ы элементов в слайдере, для случая когда изменилось количество.
            window.addEventListener('cartQuantityUpdated', event => {
                // исключаем случай когда обновление было инициировано самим слайдером.
                if ( 'slider' !== event.detail.source ) {
                    const ids = Object.keys(event.detail.products);
                    $('.lk-table-slider .swiper-container input.input-col')
                        .each((i,input) => {
                            const id = $(input).attr('data-id');
                            if (ids.includes(id)){
                                $(input).val(event.detail.products[id]);
                            }
                        });
                }
            });

        });
        //# sourceURL=customer.order.create-block-order.js
    </script>
@endpush
