<div class="lk-page-cart">
    {{-- Client Cart Livewire--}}
    <div class="lk-page-header">
        <div class="lk-page-title">@lang('custom::site.Basket')</div>
    </div>
    <div class="lk-table">
        <div class="lk-table-header">
            <div class="js-select-all custom-control custom-checkbox">
                <input
                    class="custom-control-input select-all"
                    onchange="@this.checkAll(this.checked)"
                    @if(cart()->productIds()->count() == cart()->checkedProductIds()->count()) checked @endif
                    id="select-all" type="checkbox"><label
                    class="custom-control-label"
                    for="select-all">@lang('custom::site.Choose everything')</label>
            </div>
            <button class="js-clear-list-products button button-secondary"
                    wire:click="clearList"
                    type="button">@lang('custom::site.Clear list')</button>
        </div>

        {{-- Users / Cart/ Product List --}}
        @include('livewire.manager.cart.product-list', ['products' => $products])

        <div class="lk-table-bottom">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input"
                       id="callback-off"
                       wire:model="callback_off"
                       type="checkbox"><label
                    class="custom-control-label"
                    for="callback-off">@lang('custom::site.Don call me back, Im sure of the order')</label>
            </div>
            <a class="button button-secondary" href="#modal-found-cheaper"
               data-toggle="modal">@lang('custom::site.Found cheaper?')</a>
        </div>
        <div class="lk-table-footer">
            <div class="lk-table-footer-left-row">
                <div class="lk-table-total">
                    <div class="lk-table-total__item">
                        <div class="lk-table-total__title">@lang('custom::site.total')</div>
                        <div class="lk-table-total__value">
                            <span class="lk-table-total__sum">
                                <span class="value">{{formatMoney($totals['cartCheckedCost'])}}</span> @lang('custom::site.UAH').
                            </span>
                        </div>
                    </div>
                    <div class="lk-table-total__item">
                        <div class="lk-table-total__title"></div>
                        <div class="lk-table-total__value">
                            <span class="lk-table-total__col text-lowercase">
                                @php($textProducts = numericCasesLang($totals['cartCheckedQty'], 'custom::site.product') )
                                <span class="value">{{$totals['cartCheckedQty']}}</span> {{$textProducts}}
                            </span>
                            <span class="lk-table-total__weight">
                                <span class="value">{{formatMoney($totals['weight'])}}</span> @lang('custom::site.kg') / <span
                                    class="value">{{formatMoney($totals['volume'], 3)}}</span> @lang('custom::site.k.m.')</span>
                        </div>
                    </div>
{{--                    <div class="lk-table-total__item">--}}
{{--                        <div--}}
{{--                            class="lk-table-total__title">@lang('custom::site.Estimated delivery date')</div>--}}
{{--                        <div class="lk-table-total__value"><span class="lk-table-total__date">08.12.2020</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="lk-table-bonus" @if(empty($cashbackAvailable)) style="display: none" @endif>
                    <div class="lk-table-bonus__title">@lang('custom::site.my_cashback')
                        : {{formatMoney($cashbackAvailable, 0)}}</div>
                    <div class="lk-table-bonus__form">
                        <div class="form-inline">
                            <div class="form-group">
                                <input class="form-control"
                                       wire:model.defer="cashbackToUse"
                                       onkeypress="document.useCashback(event)"
                                       type="number">
                                <script>
                                    document.useCashback = function (e) {
                                        if (e.keyCode === 13) { @this.writeOffCashback();
                                        }
                                    }
                                </script>
                            </div>
                            <div class="form-group">
                                <input class="button button-secondary"
                                       wire:click="writeOffCashback"
                                       type="button"
                                       value="@lang('custom::site.write_off')"></div>
                        </div>
                    </div>
                    @if($cashbackUsed)
                        <div class="lk-table-bonus__value" style="display: block;">
                            @lang('custom::site.will_cashback_used'):
                            <b class="text-lowercase">{{$cashbackUsed}} @lang('custom::site.uah').</b></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <livewire:manager.cart.meta-block-livewire/>
</div>

@push('custom-scripts')
    <script>
        window.addEventListener('updatePageMainValues', event => {
            // Обработчик обновления элементов на странице
            const productIds = Object.keys(event.detail.products);
            const $rows = $('.lk-table-body .js-table tbody tr:not(.footable-empty)');
            $rows.each((i, row) => {
                const id = $(row).attr('data-id');
                if (productIds.includes(id)) {
                    // Обновляем цену и сумму для каждого товара
                    const $row = $('.js-table tr.product-' + id);
                    const product = event.detail.products[id];
                    if ($row.length) {
                        $row.find('.checked-value').prop('checked', product.checked);
                        $row.find('.price-value').text(product.price);
                        $row.find('.cost-value').text(product.cartCost);
                    }
                } else {
                    // такого товара нет, удаляем строку
                    $(row).remove();
                }
            })

            if (!productIds.length && $rows.length) {
                // Если товаров нет, то удаляем все строки
                // то обновляем таблицу что бы показалась надпись "Нет данных".
                $rows.remove();
                $('.lk-table-body .js-table').footable();
            }
        });
        //# sourceURL=manager.cart.page-main.js
    </script>
@endpush
