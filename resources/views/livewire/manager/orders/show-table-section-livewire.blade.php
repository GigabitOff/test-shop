<div class="lk-table">
    <div class="lk-table-header lk-table-header--order">
        <ul class="lk-infolist">
            <li class="lk-infolist__item"><span
                    class="lk-infolist__title">@lang('custom::site.date_order'):</span><span
                    class="lk-infolist__value">{{formatDate($order->created_at)}}</span></li>
            <li class="lk-infolist__item"><span class="lk-infolist__title">@lang('custom::site.status'):</span><span
                    class="lk-infolist__value lk-infolist__value--label">{{$order->status->name ?? ''}}</span></li>
            <li class="lk-infolist__item"><span class="lk-infolist__title">@lang('custom::site.delivery'):</span><span
                    class="lk-infolist__value">{{$order->deliveryAddress->deliveryType->name ?? ''}}</span></li>
            <li class="lk-infolist__item"><span class="lk-infolist__title">@lang('custom::site.client'):</span><span
                    class="lk-infolist__value">{{$order->customer->name}}</span></li>
        </ul>
        <div class="action-group">
            <div class="action-item">
                <div class="action-item__btn"><span class="ico_user-cicrle"></span></div>
                <div class="action-item__content">
                    <div class="action-item__header">
                        <div class="action-item__title">@lang('custom::site.personal')<br>@lang('custom::site.manager')
                        </div>
                    </div>
                    <div class="action-item__body">
                        <ul>
                            @php($managerName = $order->manager ? $order->manager->name : '')
                            @php($managerEmail = $order->manager ? $order->manager->email : '')
                            @php($managerPhone = $order->manager ? $order->manager->phone : '')
                            <li><span>{{$managerName}}</span></li>
                            <li><a href="mailto:{{$managerEmail}}">{{$managerEmail}}</a></li>
                            <li><a href="tel:{{$managerPhone}}">{{formatPhoneNumber($managerPhone)}}</a></li>
                        </ul>
                        {{--                        <div class="mt-3"><a class="button button-secondary" href="#modal-callback"--}}
                        {{--                                             data-toggle="modal">@lang('custom::site.callback_to_me')</a></div>--}}
                    </div>
                </div>
            </div>
            <div class="action-item">
                <div class="action-item__btn"><span class="ico_delivery"></span></div>
                <div class="action-item__content">
                    <div class="action-item__header">
                        <div class="action-item__title">@lang('custom::site.driver')</div>
                    </div>
                    <div class="action-item__body">
                        <ul>
                            @php($driverName = $order->driver ? $order->driver->name : '')
                            @php($driverPhone = $order->driver ? $order->driver->phone : '')
                            <li><span>{{$driverName}}</span></li>
                            <li><a href="tel:{{$driverPhone}}">{{formatPhoneNumber($driverPhone)}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="action-item">
                <div class="action-item__btn"
                     onclick="document.lazyWireModal.uploadAndShow('modal-print-order', {'force':false, payload:{order_id:{{$order->id}}}})"
                >
                    <span class="ico_printer"></span>
                </div>
            </div>
        </div>
    </div>

    <ul class="lk-infolist mt-2 mb-4">
        <li class="lk-infolist__item">
            <span class="lk-infolist__title">@lang('custom::site.bonuses_earned'):</span>
            <span class="lk-infolist__value">{{formatMoney($order->bonus_earned, 0)}}</span>
        </li>
        <li class="lk-infolist__item">
            <span
                class="lk-infolist__title">@lang('custom::site.accrued') / @lang('custom::site.write_off_cashback'):</span>
            <span
                class="lk-infolist__value">{{formatMoney($order->cashback_earned, 0)}} /{{formatMoney($order->cashback_used, 0)}}</span>
        </li>
    </ul>

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
                    <div class="lk-table-total__value"><span
                            class="lk-table-total__sum">{{formatMoney($order->total)}} @lang('custom::site.uah').</span>
                    </div>
                </div>
                <div class="lk-table-total__item">
                    <div class="lk-table-total__title"></div>
                    <div class="lk-table-total__value"><span
                            class="lk-table-total__col">{{$order->total_quantity}} @lang('custom::site.products')</span><span
                            class="lk-table-total__weight">{{formatWeight($order->total_weight)}} @lang('custom::site.kg') / {{formatVolume($order->total_volume)}} @lang('custom::site.m3')</span>
                    </div>
                </div>
{{--                <div class="lk-table-total__item">--}}
{{--                    <div class="lk-table-total__title">@lang('custom::site.estimated_delivery_date')</div>--}}
{{--                    <div class="lk-table-total__value"><span--}}
{{--                            class="lk-table-total__date">&nbsp;</span></div>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="lk-table-navigation">
            @include('livewire.includes.per-page-table', ['data_paginate' => $products, 'classes' => '', 'spanClasses'=> 'lk-table-navigation__text'])

            <div class="lk-table-btns">
                @php($invoice = $order->documentInvoices->first())
                @if($invoice && $invoice->path)
                    <a class="button button-primary"
                       href="{{$invoice->fileUrl}}"
                       target="_blank"><span class="mr-2 ico_downloads"></span>@lang('custom::site.download_invoice')
                    </a>
                @endif
                @if ($order->status->isNew())
                    <a class="button button-primary"
                       wire:click="setEditOrder"
                       href="javascript:void(0);">@lang('custom::site.edit')</a>
                @elseif ($order->status->isEdited())
                    <a class="button button-primary"
                       href="{{route('manager.orders.edit', ['order'=> $order->id])}}"
                    ><span class="mr-2 ico_edit"></span>@lang('custom::site.edit')</a>
                @endif
                @if($order->documentReverses()->exists())
                    <a class="button button-primary"
                       onclick="document.lazyWireModal.uploadAndShow('modal-act-complaint-download', {'force':false, payload:{order_id:{{$order->id}}}})"
                       href="javascript:void(0);">@lang('custom::site.return_act')</a>
                @endif
                @if($order->documentComplaints()->exists())
                    <a class="button button-primary"
                       onclick="document.lazyWireModal.uploadAndShow('modal-invoice-download', {'force':false, payload:{order_id:{{$order->id}}}})"
                       href="javascript:void(0);">@lang('custom::site.complaints')</a>
                @endif
            </div>
        </div>
    </div>
    <div class="total-action total-action--clear">
        <div class="total-action__top">
            <div class="row">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-xl-3 col-md-4 mb-3">
                            <div class="form-group">
                                <div><span class="lk-infolist__title"
                                           style="padding:10px;">@lang('custom::site.payment_type'):</span>
                                </div>
                                <div
                                    class="total-action-value">{{$order->paymentType ? $order->paymentType->name : ''}}</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-4 mb-3">
                            @php($deliveryAddress = $order->deliveryAddress ?? '')
                            @php($deliveryType = $deliveryAddress->deliveryType ?? '')
                            @if($deliveryType)
                                <div class="form-group">
                                    <div><span class="lk-infolist__title"
                                               style="padding:10px;">@lang('custom::site.delivery_method'):</span>
                                    </div>
                                    <div class="total-action-value">{{$deliveryType->name}}</div>
                                </div>
                                <div class="form-group">
                                    <div class="total-action-value">{{$deliveryAddress->formatFullAddress()}}</div>
                                </div>
                            @endif
                        </div>
                        <div class="col-xl-3 col-md-4 mb-3">
                            <div class="form-group">
                                <div><span class="lk-infolist__title"
                                           style="padding:10px;">@lang('custom::site.recipient'):</span>
                                </div>
                                <div
                                    class="total-action-value">{{$order->recipient->name ?? $order->customer->name}}</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col">
                            <div class="form-group">
                                <div><span class="lk-infolist__title"
                                           style="padding:10px;">@lang('custom::site.Comment'):</span>
                                </div>
                                <div class="total-action-value">{{$order->comment}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });
        })
        //# sourceURL=orders.edit-table-section.js
    </script>
@endpush
