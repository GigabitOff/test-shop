<div class="lk-page__main">
    <div class="lk-page-header">
        <div class="lk-page-header__left">
            <a class="decor-link decor-link--left" href="{{route('customer.documents.index')}}"
               data-da=".lk-btn-back, 1359">
                <span><span class="ico_arrow-l"></span>@lang('custom::site.return')</span></a>
            <div class="lk-page-title">@lang('custom::site.complaint_act')</div>
        </div>
    </div>
    <div class="lk-table">
        <div class="lk-table-header">
            <ul class="lk-infolist">
                <li class="lk-infolist__item">
                    <span class="lk-infolist__title">@lang('custom::site.date'):</span>
                    <span class="lk-infolist__value">{{formatDate($order->created_at)}}</span></li>
                <li class="lk-infolist__item">
                    <span class="lk-infolist__title">@lang('custom::site.order'):</span>
                    <span class="lk-infolist__value">№ {{$order->id}}</span></li>
                <li class="lk-infolist__item">
                    <span class="lk-infolist__title">@lang('custom::site.client'):</span>
                    <span class="lk-infolist__value">{{$order->customer->name}}</span></li>
            </ul>
            <div class="lk-table-header-action">
                <div class="action-group">
                    <div class="action-item">
                        <div class="action-item__btn"
                             onclick="document.lazyWireModal.uploadAndShow('modal-print-order', {'force':false, payload:{order_id:{{$order->id}}}})"
                             data-da=".lk-btn-empty, 767">
                            <span class="ico_printer"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <div class="lk-table-total__title">@lang('custom::site.total_sum')</div>
                        <div class="lk-table-total__value">
                            <span
                                class="lk-table-total__sum text-lowercase">{{formatMoney($totals['cost'])}} @lang('custom::site.uah').</span>
                            @php($textProducts = numericCasesLang($totals['quantity'], 'custom::site.product') )
                            <span class="lk-table-total__size">{{$totals['quantity']}} {{$textProducts}}</span></div>
                    </div>
                </div>
                <div class="lk-table-btns">
                    <a class="button button-primary"
                       wire:click="onShowModal"
                       href="javascript:void(0);">@lang('custom::site.create')</a></div>
            </div>
            @include('livewire.includes.per-page-table', ['data_paginate' => $products])
        </div>
    </div>
</div>

@push('show-data')
    {{-- Форма создания акта рекламации --}}
    <x-modal-form id="modal-act-complaint">
        <livewire:forms.act-complaint-livewire/>
    </x-modal-form>
@endpush

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });
        })

        document.complaintInvoice = {
            setChecked: function (element) {
                const productId = $(element).data('product_id');
                const checked = $(element).prop('checked');

                $(element).closest('table').find('input[type=checkbox]').prop('checked', false);
                $(element).prop('checked', checked);
            @this.setChecked(productId, checked);
            },
        }
        //# sourceURL=customer.documents.return-invoice.create-page-main-livewire.js
    </script>
@endpush
