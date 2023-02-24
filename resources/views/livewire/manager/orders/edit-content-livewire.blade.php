<div class="lk-page-cart">
    {{-- Client Cart Livewire--}}
    <div class="lk-page-header">
        <div class="lk-page-header__left">
            <a class="decor-link decor-link--left"
               href="{{route('customer.orders.index')}}"><span><span
                        class="ico_arrow-l"></span>@lang('custom::site.return')</span></a>
            <div class="lk-page-title">@lang('custom::site.edit_order') № {{$order->order_id}}</div>
        </div>
    </div>
    <div class="lk-table">
        <div class="lk-table-header">
            <div class="lk-table-search">
                <x-livewire.custome-filterable
                    type="custome-dropdown-search"
                    :placeholder="__('custom::site.search')"
                    name="filterableSearch"
                    model="filterableSearch.value"
                    :key="$filterableSearch['id']"
                    :list="$filterableSearch['list']"
                    :edit="$filterableMode === 'filterableSearch'"
                >
                </x-livewire.custome-filterable>
            </div>
            <button class="js-clear-list-products button button-secondary"
                    wire:click="clearList"
                    type="button">@lang('custom::site.Clear list')</button>
        </div>

        {{-- Product List --}}
        <div id="product-list-livewire" class="lk-table-body">
            <div id="footable-content" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
            <table id="footable-holder" data-show-toggle="true" data-empty="@lang('custom::site.data_is_absent')"
                   data-toggle-column="last" wire:ignore></table>
        </div>

        <div class="lk-table-bottom">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input"
                       id="callback-off"
                       wire:model="callback_off"
                       type="checkbox"><label
                    class="custom-control-label"
                    for="callback-off">@lang('custom::site.Don call me back, Im sure of the order')</label>
            </div>
            <a class="button button-secondary"
               wire:click="cancelEditOrder"
               href="javascript:void(0);">@lang('custom::site.cancel_edit')</a>
        </div>
        <div class="lk-table-footer">
            <div class="lk-table-footer-left-row">
                <div class="lk-table-total">
                    <div class="lk-table-total__item">
                        <div class="lk-table-total__title">@lang('custom::site.total')</div>
                        <div class="lk-table-total__value">
                            <span class="lk-table-total__sum">
                                <span class="value">{{formatMoney($totals['cost'])}}</span> @lang('custom::site.UAH').
                            </span>
                        </div>
                    </div>
                    <div class="lk-table-total__item">
                        <div class="lk-table-total__title"></div>
                        <div class="lk-table-total__value">
                            <span class="lk-table-total__col text-lowercase">
                                <span class="value">{{$totals['quantity']}}</span> @lang('custom::site.products')
                            </span>
                            <span class="lk-table-total__weight">
                                <span class="value">{{formatWeight($totals['weight'])}}</span> @lang('custom::site.kg') / <span
                                    class="value">{{formatVolume($totals['volume'])}}</span> @lang('custom::site.k.m.')</span>
                        </div>
                    </div>
{{--                    <div class="lk-table-total__item">--}}
{{--                        <div--}}
{{--                            class="lk-table-total__title">@lang('custom::site.Estimated delivery date')</div>--}}
{{--                        <div class="lk-table-total__value"><span class="lk-table-total__date">08.12.2020</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="lk-table-bonus">
                    <div class="lk-table-bonus__title">@lang('custom::site.my_cashback')
                        : {{formatMoney($cashbackAvailable, 0)}}</div>
                    <div class="lk-table-bonus__form">
                        <div class="form-inline">
                            <div class="form-group">
                                <input class="form-control"
                                       wire:model.defer="cashbackToUse"
                                       onkeypress="document.useCashback(event, this.value)"
                                       type="number">
                                <script>
                                    document.useCashback = function (e, value) {
                                        if (e.keyCode === 13) { @this.writeOffCashback(value);}
                                    }
                                </script>
                            </div>
                            <div class="form-group">
                                <input class="button button-secondary"
                                       onclick="@this.writeOffCashback($(this).closest('.lk-table-bonus').find('input[type=number]').val())"
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
    <livewire:manager.orders.edit-meta-block-livewire :order="$order" />
</div>

@push('custom-styles')
    <style>
        .lk-page-cart .lk-table-header {
            margin-left: unset;
        }
    </style>
@endpush


@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });
        });

        window.addEventListener('updateProductTableValues', event => {
            // Обработчик обновления элементов на странице
            const productIds = Object.keys(event.detail.products);
            const $rows = $('.lk-table-body tbody tr:not(.footable-empty)');
            productIds.forEach(id => {
                // Обновляем цену и сумму для каждого товара
                const $row = $('.lk-table-body tbody tr.product-' + id);
                const product = event.detail.products[id];
                if ($row.length) {
                    $row.find('.price-value').text(product.orderPrice);
                    $row.find('.cost-value').text(product.orderCost);
                    $row.addClass('values-updated');
                }
            })

            $rows.each((i, row) => {
                // Удаляем все незатронутые строки
                if (! $(row).hasClass('values-updated')) {
                    $(row).remove();
                }
            })

            // Очищаем метку обновления
            $('.lk-table-body tbody tr').removeClass('values-updated');

            if ((!productIds.length && $rows.length) || !$rows.length ) {
                // Если товаров нет, то удаляем все строки
                // то обновляем таблицу что бы показалась надпись "Нет данных".
                $rows.remove();
                document.FooTableEx.redraw('#footable-content');
            }
        });

        document.orderEditProduct = {
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
            remove: function(uuid){
            @this.removeProduct(uuid);
            },
        }

        //# sourceURL=customer.orders.edit-content-livewire.js
    </script>
@endpush
