<div class="lk-page-cart">
    {{-- Client Cart Livewire--}}
    <div class="lk-page-header">
        <div class="lk-page-title">@lang('custom::site.Basket')</div>
    </div>
    <div class="lk-table">
        <div class="lk-table-header">
            <div class="js-select-all custom-control custom-checkbox">
{{--                <input--}}
{{--                    class="custom-control-input select-all"--}}
{{--                    onchange="@this.checkAll(this.checked)"--}}
{{--                    @if(cart()->productIds()->count() == cart()->checkedProductIds()->count()) checked @endif--}}
{{--                    id="select-all" type="checkbox"><label--}}
{{--                    class="custom-control-label"--}}
{{--                    for="select-all">@lang('custom::site.Choose everything')</label>--}}
            </div>
            <button class="js-clear-list-products button button-secondary"
                    wire:click="clearList"
                    type="button">@lang('custom::site.Clear list')</button>
        </div>

        {{-- Users / Cart/ Product List --}}
{{--        @include('livewire.customer.cart.products-footable-render', ['products' => $products])--}}
        <div class="lk-table-body">
            <div id="footable-content" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
            <table wire:ignore id="footable-holder"
                   data-empty="@lang('custom::site.data_is_absent')"
                   data-show-toggle="true" data-toggle-column="last">
            </table>
        </div>

        <div class="lk-table-footer">
            <div class="lk-table-footer-left-row">
                <div class="lk-table-total">
                    <div class="lk-table-total__item">
                        <div class="lk-table-total__title">@lang('custom::site.total')</div>
                        <div class="lk-table-total__value">
                            <span class="lk-table-total__sum">
                                <span class="value">{{formatMoney(cart()->totalCartCheckedCost())}}</span> @lang('custom::site.UAH').
                            </span>
                        </div>
                    </div>
                    <div class="lk-table-total__item">
                        <div class="lk-table-total__title"></div>
                        <div class="lk-table-total__value">
                            <span class="lk-table-total__col text-lowercase">
                                <span class="value">{{cart()->totalCartCheckedQuantity()}}</span> @lang('custom::site.products')
                            </span>
                            <span class="lk-table-total__weight">
                                @php($totalWeight = cart()->checkedProducts()->map->weight->sum())
                                @php($totalVolume = cart()->checkedProducts()->map->volume->sum())
                                <span class="value">{{$totalWeight}}</span> @lang('custom::site.kg') / <span
                                    class="value">{{$totalVolume}}</span> @lang('custom::site.k.m.')</span>
                        </div>
                    </div>
                    <div class="lk-table-total__item">
                        <div
                            class="lk-table-total__title">@lang('custom::site.Estimated delivery date')</div>
                        <div class="lk-table-total__value"><span class="lk-table-total__date">08.12.2020</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lk-page-total">
        <div class="total-action">
            <div class="total-action__top">
                <div class="row">
                    <div class="col-xl-10"></div>
                    <div class="col-xl-2 text-right">
                        <button class="button button-secondary button-block"
                                wire:click="createOrder"
{{--                                data-toggle="modal" data-target="#modal-quick-purchase"--}}
                                type="button">@lang('custom::site.Confirm')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    @livewire('customer.cart.meta-block-livewire')--}}
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });
        })
        window.addEventListener('showQuickPurchaseModal', event => {
           $('#modal-quick-purchase').modal('show');
        });

        window.addEventListener('updateCheckAllCheckbox', event => {
            $('#check-all').prop('checked', event.detail.checkAll);
        })

        window.addEventListener('updatePageMainValues', event => {
            // Обработчик обновления элементов на странице 
            const productIds = Object.keys(event.detail.products);
            const $rows = $('.lk-table-body tbody tr:not(.footable-empty)');
            productIds.forEach(id => {
                // Обновляем цену и сумму для каждого товара
                const $row = $('.lk-table-body tbody tr.product-' + id);
                const product = event.detail.products[id];
                if ($row.length) {
                    $row.find('.checked-value').prop('checked', product.checked);
                    $row.find('.price-value').text(product.price);
                    $row.find('.cost-value').text(product.cartCost);
                    $row.addClass('values-updated');
                    // $row.toggleClass('row-hidden', product.hide);
                    // if (product.hide) {
                    //     $row.hideaddClass('row-hidden');
                    // } else {
                    //     $row.removeClass('row-hidden');
                    // }
                }
            })

            $rows.each((i, row) => {
                // Удаляем все незатронутые строки
                if (!$(row).hasClass('values-updated')) {
                    $(row).remove();
                }
            })

            // Очищаем метку обновления
            $('.lk-table-body tbody tr').removeClass('values-updated');

            if ((!productIds.length && $rows.length) || !$rows.length) {
                // Если товаров нет, то удаляем все строки
                // то обновляем таблицу что бы показалась надпись "Нет данных".
                $rows.remove();
                document.FooTableEx.redraw('#footable-content');
            }
        });

        document.cartProduct = {
            changeQuantity: function (input, uuid) {
                const $input = $(input);
                const max = $input.attr('data-max');
                let value = $input.val();

                if (1*value <= 0){
                    value = 1;
                    $input.val(value);
                }

                if (max !== undefined && 1*value > 1*max) {
                    $input.val(max);
                }

            @this.changeProductQuantity(uuid, value);
            },
            remove: function (productId) {
            @this.removeProduct(productId);
            },
            setCheck: function (productId, checked) {
            @this.setCheckProduct(productId, checked);
            }
        }

        //# sourceURL=customer.cart.page-main.js
    </script>
@endpush
