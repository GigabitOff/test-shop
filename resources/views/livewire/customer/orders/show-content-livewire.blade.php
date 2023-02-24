<div class="lk-page__content">
    <div class="lk-page__head --justify">
        <div>
            <div class="lk-page__back">
                <a class="button-back" href="{{route('customer.orders.index')}}">
                    @lang('custom::site.return')<i class="ico_angle-left"></i>
                </a>
            </div>
            <h1 class="lk-page__title">@lang('custom::site.order') № {{$order->id}}</h1>
            <div class="lk-page__empty"></div>
        </div>
        <div class="da"></div>
    </div>
    <div class="lk-page__action">
        <div class="lk-page__order-info">
            <div class="order-info-item">
                <div class="order-info-item__label">
                    @lang('custom::site.date_order') /
                    @lang('custom::site.order_status')
                </div>
                <div class="order-info-item__value">
                    {{formatDate($order->registry_date)}} /
                    {{$order->status->title ?? ''}}
                </div>
            </div>
            <div class="order-info-item">
                <div class="order-info-item__label">
                    @lang('custom::site.delivery') /
                    @lang('custom::site.status')
                </div>
                <div class="order-info-item__value">
                    {{$order->deliveryAddress->deliveryType->name ?? ''}} /
                    {{'undefined'}}
                </div>
            </div>
            <div class="order-info-item">
                <div class="order-info-item__label">@lang('custom::site.client')</div>
                <div class="order-info-item__value">{{$order->customer->name}}</div>
            </div>
        </div>
        <div class="lk-page__action-btns">
            <div class="button-info-group" data-da=".da, 1359">
                <div class="button-info">
                    <button class="button-info__button ico_user" type="button"></button>
                    <div class="button-info__dropdown">
                        <div class="button-info__title">@lang('custom::site.personal_manager')</div>
                        <div class="button-info__content">
                            @php($manager = $order->manager)
                            <span>{{$manager->name ?? ''}}</span>
                            <a href="mailto:{{$manager->email ?? ''}}">{{$manager->email ?? ''}}</a>
                            <a href="tel:{{$manager->phone ?? ''}}">{{formatPhoneNumber($manager->phone ?? '')}}</a>
                        </div>
                    </div>
                </div>
                <div class="button-info">
                    <button class="button-info__button ico_driver" type="button"></button>
                    <div class="button-info__dropdown">
                        <div class="button-info__title">@lang('custom::site.company_driver')</div>
                        <div class="button-info__content">
                            @php($driver = $order->driver)
                            <span>{{$driver->name ?? ''}}</span>
                            <a href="mailto:{{$driver->email ?? ''}}">{{$driver->email ?? ''}}</a>
                            <a href="tel:{{$driver->phone ?? ''}}">{{formatPhoneNumber($driver->phone ?? '')}}</a>
                        </div>
                    </div>
                </div>

                <button class="button-circle ico_print"
                        onclick="Livewire.emit('eventShowPrintOrder', {'orderId': {{$order->id}}})"
                        type="button"></button>
            </div>
        </div>
    </div>

    <div class="lk-page__table">
        <div id="footable-content"
             class="footable-content @if($this->isNeedRevalidateFootable()) footable-revalidate @endif"
             style="display: none">
            @include('livewire.customer.orders.show-footable-render')
        </div>
        <table wire:ignore id="footable-holder" class="ftable"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>

    </div>

    <div class="lk-page__table-after">
        <div>
            <dl class="table-total">
                @php($text = numericCasesLang($order->total_quantity, 'custom::site.product') )
                <dt>@lang('custom::site.total_sum') ( {{$order->total_quantity}} <span
                        class="text-lowercase">{{$text}}</span> )
                </dt>
                <dd class="big text-lowercase">{{formatNbsp(formatMoney($order->total))}} @lang('custom::site.uah')</dd>
                <dt>Дата поставки ??</dt>
                <dd>23.02.22 ??</dd>
            </dl>
            <div class="lk-page__table-after-btns" data-da=".lk-page__table-after, 1199, 2">
                @php($invoice = $order->documentInvoices->first())
                @if($invoice && $invoice->path)
                    <a class="button-outline ico_download"
                       href="{{$invoice->fileUrl}}"
                       target="_blank">@lang('custom::site.download_invoice')</a>
                @endif
                @if ($order->status->isNew())
                    <a class="button-outline ico_download" wire:click="setEditOrder"
                       href="javascript:void(0);">@lang('custom::site.edit')</a>
                @elseif ($order->status->isEdited())
                    <a class="button-outline ico_download"
                       href="{{route('customer.orders.edit', ['order'=> $order->id])}}"
                    >@lang('custom::site.edit')</a>
                @endif
                @if($order->documentReverses()->exists())
                    <a class="button-outline ico_download"
                       onclick="document.lazyWireModal.uploadAndShow('modal-act-complaint-download', {'force':false, payload:{order_id:{{$order->id}}}})"
                       href="javascript:void(0);">@lang('custom::site.return_act')</a>
                @endif
                @if($order->documentComplaints()->exists())
                    <a class="button-outline ico_download"
                       onclick="document.lazyWireModal.uploadAndShow('modal-invoice-download', {'force':false, payload:{order_id:{{$order->id}}}})"
                       href="javascript:void(0);">@lang('custom::site.complaints')</a>
                @endif

                {{--                <a class="button-outline ico_download" href="assets/img/exsamle.pdf" target="_blank">Завантажити--}}
                {{--                    рахунок</a>--}}
                {{--                <a class="button-outline ico_download" href="#m-return-product-big"--}}
                {{--                                  data-bs-toggle="modal">Завантажити накладну</a><a class="button-outline"--}}
                {{--                                                                                    href="#m-akt-return-product"--}}
                {{--                                                                                    data-bs-toggle="modal">Акт--}}
                {{--                    повернення</a><a class="button-outline" href="#m-return-product"--}}
                {{--                                     data-bs-toggle="modal">Рекламації</a>--}}
            </div>
        </div>
        <div>
            @include('livewire.includes.per-page-footable', ['paginator' => $products])
        </div>
    </div>

    <div class="lk-page__table-total-action">
        <div class="order-form">
            <div class="order-form-values">
                <div class="row g-5">
                    <div class="col-xl-3">
                        <div class="order-block --pay">
                            <h3 class="order-block-title">@lang('custom::site.payment_type')</h3>
                            <div class="order-block-value">{{$order->paymentType->name}}</div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        @php($deliveryAddress = $order->deliveryAddress ?? '')
                        @php($deliveryType = $deliveryAddress->deliveryType ?? '')
                        @if($deliveryType)
                            <div class="order-block --delivery">
                                <div class="form-group">
                                    <h3 class="order-block-title">@lang('custom::site.delivery_method')</h3>
                                    <div class="order-block-value">{{$deliveryType->name}}</div>
                                </div>
                                <div class="form-group">
                                    <div class="order-block-value">{{$deliveryAddress->formatFullAddress()}}</div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="col-xl-3">
                        <div class="order-block --customer">
                            <h3 class="order-block-title">@lang('custom::site.recipient')</h3>
                            <div class="order-block-value">{{$order->recipient->name ?? $order->customer->name}}</div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="order-block --comment">
                            <h3 class="order-block-title">@lang('custom::site.Comment')</h3>
                            <textarea class="form-control order-block-value" disabled
                                      placeholder="@lang('custom::site.Comment')">{{$order->comment}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
