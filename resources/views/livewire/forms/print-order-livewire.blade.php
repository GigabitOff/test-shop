<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.print_order')
            <small>@lang('custom::site.on_project_domain')</small></h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">

        <div class="lk-modal__sort">
            <div class="lk-page__sort-items">
                <div class="filter-sort-item @if($printWithSale) is-active @endif">
                    <a class="filter-sort-item__link"
                       wire:click="printWithSale"
                       href="javascript:void(0);">
                        <span class="filter-sort-item__title">@lang('custom::site.with_sale')</span>
                    </a>
                </div>
                <div class="filter-sort-item @if(!$printWithSale) is-active @endif">
                    <a class="filter-sort-item__link"
                       wire:click="printWithoutSale"
                       href="javascript:void(0);">
                        <span class="filter-sort-item__title">@lang('custom::site.without_sale')</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div id="mpo_footable-content"
                 class="footable-content @if($this->isNeedRevalidateFootable()) footable-revalidate @endif"
                 style="display: none">
                @include('livewire.forms.print-order-footable-render')
            </div>
            <table wire:ignore id="mpo_footable-holder"
                   class="ftable table-print-order"
                   data-empty="@lang('custom::site.data_is_absent')"
                   data-show-toggle="true" data-toggle-column="last">
            </table>
        </div>

        <div class="form-group">
            <div class="m-print-order__footer">
                <dl class="table-total">
                    @php($text = numericCasesLang($order->total_quantity, 'custom::site.product') )
                    <dt>@lang('custom::site.total_sum') ( {{$order->total_quantity}} {{$text}} )</dt>
                    <dd class="big text-lowercase">{{formatNbsp(formatMoney($order->totalCost))}} @lang('custom::site.uah')</dd>
                </dl>
                <button class="button-accent button-accent"
                        onclick="window.printPopup();"
                        type="button">@lang('custom::site.do_print')</button>
            </div>
        </div>

    </div>
    <script>
        window.printPopup = function () {
            /**
             * Для печати таблицы в полном формате в мобильной версии
             * подменяем таблицу из holder-a
             */
            const $printable = $('#m-print-order .modal-body').clone();
            // const tableData = $('#mpo_footable-content').html();

            $printable.find('#m-print-order .lk-modal__sort').remove();
            // $printable.prepend(tableData);
            // $printable.find('#mpo_footable-holder').remove();
            $printable.find('#mpo_footable-content').remove();

            const newWin = window.open('', 'Print-Window');

            newWin.document.open();

            newWin.document.write(
                '<html> ' +
                '   <link rel="stylesheet" href="/assets/css/main.css">' +
                '   <body onload="setTimeout(function(){window.print()},90)">' +
                '       <style>' +
                '           .footer-popup button{display:none !important;}' +
                '           .popup-print__orders .popup-print__orders--content ' +
                '           .table-content{ padding:7px;} .modal-dialog{ align-items: baseline; } ' +
                '       </style>' +
                $printable.html() +
                '   </body>' +
                '</html>'
            );

            setTimeout(function () {
                newWin.print();
            }, 300);
        }

        window.addEventListener('mpo_updateFooTableValues', event => {
            // Обработчик обновления элементов на странице
            const productIds = Object.keys(event.detail.products);
            productIds.forEach(id => {
                // Обновляем цену и сумму для каждого товара
                const $row = $('#mpo_footable-holder tbody tr.product-' + id);
                const product = event.detail.products[id];
                if ($row.length) {
                    // $row.find('.price-value').text(product.orderPrice);
                    $row.find('.cost-value').text(product.orderCost);
                }
            })

            $('#mpo_footable-holder thead .with-sale-text').text(event.detail.withSaleText || '');
        });

        //# sourceURL=print-order-livewire.js
    </script>
</div>
