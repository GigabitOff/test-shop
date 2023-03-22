<div class="modal-content" >
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.print_order')
            <small>@lang('custom::site.on_project_domain')</small>
        </h5><button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        <div class="lk-modal__sort">
            <div class="lk-page__sort-items">

                <div class="filter-sort-item @if($printWithSale) is-active @endif">
                    <a class="filter-sort-item__link" href="#!" wire:click="printWithSale">
                        <span class="filter-sort-item__title">

                        @lang('custom::site.with_sale')</span>
                    </a></div>
                <div class="filter-sort-item @if(!$printWithSale) is-active @endif">
                    <a class="filter-sort-item__link" href="#!" wire:click="printWithoutSale">
                        <span class="filter-sort-item__title">
                            @lang('custom::site.without_sale')</span>
                    </a></div>
            </div>
        </div>
        <div class="form-group print-overflow">
            <table id="mpo_footable-content" class="ftable">
                <thead>
                <tr class="footable-header">
                    <th class="footable-first-visible" style="display: table-cell;">№</th>
                    <th style="display: table-cell;">@lang('custom::site.product_name')</th>
                    <th data-breakpoints="xs" style="display: table-cell;">@lang('custom::site.product_status')</th>
                    <th data-breakpoints="xs" style="display: table-cell;">@lang('custom::site.quantity')</th>
                    <th data-breakpoints="xs" style="display: table-cell;">
                        @if($printWithSale)
                            @lang('custom::site.sum')<br>
                            @lang('custom::site.with_sale')
                        @else
                            @lang('custom::site.sum')<br>
                            @lang('custom::site.without_sale')
                        @endif
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr >
                        <td class="footable-first-visible" style="display: table-cell;">
                            <span>{{$product->articul}}</span>
                        </td>
                        <td style="display: table-cell;">
                            <a class="big" href="{{route('products.show', $product->slug)}}">
                                {{$product->name}}</a>
                        </td>
                        <td>
                            <div class="status {{$product->availabilityCss}}">
                                <span class="circle"></span>
                                <span>{{$product->statusText}}</span>
                            </div>
                        </td>

                        {{--<td>
                            <span id="ms">{{$product->cartQuantity}}</span>
                        </td>--}}
                        <td>
                            <span >{{$product->cartQuantity}}</span>
                        </td>


                        <td >
                            @if($printWithSale && $product->price_wholesale != 0)
                                @if($product->price_sale_show != 0)
                                    {!! formatNbsp(formatMoney($product->price_sale * $product->cartQuantity) . ' ₴') !!}
                                @else
                                    @if($product->price_wholesale > 0)
                                        {!! formatNbsp(formatMoney($product->price_wholesale * $product->cartQuantity) . ' ₴') !!}
                                    @else
                                        {!! formatNbsp(formatMoney($product->price_rrc * $product->cartQuantity) . ' ₴') !!}
                                    @endif
                                @endif
                            @else
                                {!! formatNbsp(formatMoney($product->price_rrc * $product->cartQuantity) . ' ₴') !!}
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>

        <div class="form-group" id="mpo_footable-content">
            <div class="m-print-order__footer">
                <dl class="table-total">
                    <dt>@lang('custom::site.total') ({{cart()->totalQuantity()}}
                        @lang('custom::site.products') )
                    </dt>
                    <dd  class="big">
                        {{$totalCost}}
                        @lang('custom::site.UAH')
                    </dd>
                </dl>
                <button class="button-accent button-accent" type="button"
                        data-bs-dismiss="modal" onclick="window.printPopup();">
                    @lang('custom::site.do_print')
                </button>
            </div>
        </div>
    </div>

    <script>
        window.printPopup = function () {
            /**
             * Для печати таблицы в полном формате в мобильной версии
             * подменяем таблицу из holder-a
             */
            const $printable = $('#m-print-cart-order .modal-body').clone();
            // const tableData = $('#mpo_footable-content').html();

            //$('.lk-modal__sort').remove();
            // $printable.prepend(tableData);
            // $printable.find('#mpo_footable-holder').remove();
            //$('.modal-body').remove();

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


        }
        //# sourceURL=print-order-livewire.js
    </script>

</div>
<script>
    setInterval(function() {
        $('#mst').load(location.href + ' #mst');
    }, 1000);
</script>

<script>
    var modal = document.getElementById('m-print-cart-order');
    modal.addEventListener('show.bs.modal', function (event) {
            var item = document.querySelector('.filter-sort-item');
            item.querySelector('a').click();
        }
    );
</script>
