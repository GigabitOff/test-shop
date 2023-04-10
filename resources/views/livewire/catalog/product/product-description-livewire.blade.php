@if($data->technical_description)
    <div class="product-full-box --technical-description">
        <div class="description-cont">
            <div class="description-cont__left">
                <div class="product-full-box__head">
                    <div class="product-full-box__title">@lang('custom::site.Technical description')</div>
                </div>
            </div>
        </div>
        <div class="product-full-box__body --overflow">
            {!! $data->technical_description !!}
        </div>
        @if($data->instructions->isNotEmpty())
            <div class="description-cont__right">
                <div class="px-md-4">
                    <div class="product-full-box__head">
                        <div class="product-full-box__title">@lang('custom::site.Instructions')</div>
                    </div>
                    <div class="product-full-box__body --overflow --instruction">
                        <ul class="instructions">
                            @foreach($data->instructions as $instruction)
                                <li>
                                    <a class="instructions__link"
                                       href="{{\Storage::disk('public')->url($instruction->url)}}"
                                       target="_blank">
                                        <div class="instructions__img">
                                            <img src="/assets/img/instructions.svg" alt="instructions">
                                        </div>

                                        {{isset($instruction->file_description) ? $instruction->file_description : $instruction->file_name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif

<script>
    window.printPopup = function () {
        /**
         * Для печати таблицы в полном формате в мобильной версии
         * подменяем таблицу из holder-a
         */
        const $printable = $('.instruction-item').clone();
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

        setTimeout(function () {
            newWin.print();
        }, 300);
    }


    //# sourceURL=print-order-livewire.js
</script>
