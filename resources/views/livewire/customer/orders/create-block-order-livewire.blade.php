<div>
    <div class="lk-page__slider-products">
        <div class="section-header">
            <h3 class="section-title">@lang('custom::site.products_selected')</h3>
            <button class="button-outline"
                    wire:click="clearCart"
                    type="button">@lang('custom::site.clear_list')</button>
            <div id="slides-house" class="slides-house" style="display: none;" data-house="{{$swiper}}"></div>
        </div>
        <div class="section-content">
            <div class="products-select js-products-select" wire:ignore>
                <div class="swiper swiper-container">
                @include('livewire.customer.orders.create-swiper-render', ['products' => $products])
                </div>
                <div class="swiper-nav --section-slider-nav --mobile">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="lk-page__table-after">
        <div class="align-items-start">
            <dl class="table-total">
                @php($text = numericCasesLang(cart()->totalQuantity(), 'custom::site.product'))
                @php($rrpSum = cart()->products()->map(fn($p)=>$p->cartQuantity * $p->rrc)->sum())
                <dt>@lang('custom::site.total_sum') ( {{cart()->totalQuantity()}} {{$text}} )</dt>
                <dd class="big text-lowercase">{{formatMoney(cart()->totalCost())}} @lang('custom::site.uah')</dd>
                <dt>@lang('custom::site.price_rrp')</dt>
                <dd class="text-lowercase">{{$rrpSum}} @lang('custom::site.uah')</dd>
                <dt>@lang('custom::site.delivery date')</dt>
{{--                // ToDo: заполнить правильную дату--}}
                <dd>23.02.22</dd>
            </dl>
            <div class="lk-page__table-after-btns">
                <a class="button-accent"
                        href="{{route('customer.cart')}}"
                        type="button">@lang('custom::site.to_order')</a></div>
        </div>
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
                            document.createOrderSlider.appendSlide(el);
                        }
                    })
                    // Удаляем слайды отсутствующие в обновлении.
                    $exist.each((i, el) => {
                        const id = $(el).find('.product-card').attr('data-id');
                        if (!newestIds.includes(id)) {
                            $(el).find('.product-card').fadeOut('300');
                            setTimeout(() => document.createOrderSlider.removeSlide(i), 400);
                        }
                    })
                    // Обновляем количество для всех слайдов.
                    // Закоментировано по причине выделения в отдельный метод
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
                    $('.swiper-container .product-card')
                        .each((i,el) => {
                            const id = $(el).attr('data-id');
                            if (ids.includes(id)){
                                $(el).find('.product-cart-quantity').text(event.detail.products[id]);
                            }
                        });
                }
            });

        });
        //# sourceURL=customer.order.create-block-order.js
    </script>
@endpush
