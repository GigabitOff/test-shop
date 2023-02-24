<table>
    <thead>
    <tr>
        <th>№ / @lang('custom::site.date')</th>
        <th class="text-center">@lang('custom::site.date')<br> {{Str::lower(__('custom::site.shipment'))}}</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.order')</th>
        <th data-breakpoints="xs">@lang('custom::site.delivery')</th>
        <th class="text-end w-1"></th>
        <th data-breakpoints="all"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $order)
        <tr>
            <td>
                <div data-label="№ / @lang('custom::site.date')">
                    <a class="cell-number" href="{{route('customer.orders.show', $order->id)}}">№ {{$order->id}}</a>
                    <span class="cell-date text-lowercase">@lang('custom::site.from') {{formatDate($order->created_at)}}</span></div>
            </td>
            <td class="text-center">
                <div data-label="@lang('custom::site.date_shipment')"><span>{{formatDate($order->date_delivery)}}</span>
                </div>
            </td>
            <td class="text-md-center">
                <div data-label="@lang('custom::site.order')">
                    <div class="price-size">
                        <strong class="cell-price text-lowercase">{{formatMoney($order->total)}} @lang('custom::site.uah').</strong>
                        <span
                            class="cell-size">{{$order->total_quantity}} {{Str::lower(numericCasesLang($order->total_quantity, 'custom::site.product'))}}</span>
                    </div>
                </div>
            </td>
            <td>
                <div data-label="@lang('custom::site.delivery')"><img src="/assets/img/{{$order->deliveryIcon}}"
                                                                     alt="image"></div>
            </td>
            <td class="text-end w-1"></td>
            <td>
                <div class="table-inner --reverse-invoices">
                    @foreach($order->documentReverses as $document)
                        <div class="table-inner__row">
                            <div class="table-inner__cell">
                                <div>
                                    <span class="cell-number">№ {{$document->registry_no}}</span>
                                    <span
                                        class="cell-date text-lowercase">@lang('custom::site.from') {{formatDate($document->date_at)}}</span>
                                </div>
                            </div>
                            <div class="table-inner__cell">
                                <div class="table-inner__product">
                                    @php $imageUrls = $document->imageUrls; @endphp
                                    @if($imageUrls->isNotEmpty())
                                        <div class="table-inner__product-img">
                                            <a href="{{$imageUrls->first()}}"
                                               data-fancybox="gallery-{{$document->id}}">
                                                <img src="{{$imageUrls->first()}}" alt="image">
                                                <span><span class="ico_pic"></span><span>{{$imageUrls->count()}}</span></span>
                                            </a>
                                            <div hidden>
                                                @foreach($imageUrls->slice(1) as $url)
                                                    <a href="{{$url}}" data-fancybox="gallery-{{$document->id}}"></a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div class="table-inner__product-txt">
                                        <span>{{$document->response}}</span></div>
                                </div>
                            </div>
                            <div class="table-inner__cell">
                                <div>
                                    @if($document->isDocumentStatusProcessing())
                                        <span class="call-stat waiting">
                                            <span class="ico_check"></span>
                                            <span>@lang('custom::site.under_consideration')</span>
                                        </span>
                                    @elseif($document->isDocumentStatusApproved())
                                        <span class="call-stat success">
                                            <span class="ico_check"></span>
                                            <span>@lang('custom::site.accepted')</span>
                                        </span>
                                    @else
                                        <span class="call-stat rejected">
                                            <span class="ico_check"></span>
                                            <span>@lang('custom::site.rejected')</span>
                                        </span>
                                    @endif
                                </div>
                                <div>
                                    @if($document->path)
                                        <a class="cell-btn"
                                           href="{{$document->fileUrl}}"
                                           target="_blank">
                                            <span class="ico_downloads"></span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-inner__info">
                            <ul class="table-inner-list">
                                @foreach($document->products as $product)
                                    @php
                                        $category = $product->categories->first();
                                        $url = $category ? route('catalog.show_single', ['slug'=>$category->seoSlug]) : 'javascript:void(0);';
                                        $target = $category ? '_blank' : '';
                                    @endphp

                                    <li class="table-inner-list__item">
                                        <div>
                                            <a class="table-inner-list__title"
                                               href="{{$url}}"
                                               target="{{$target}}">{{$product->name}}</a>
                                            <span class="table-inner-list__number">№ {{$product->articul}}</span>
                                        </div>
                                        <div>
                                            <div class="table-inner-list__price text-lowercase">{{formatMoney($product->pivot->price_nds)}} @lang('custom::site.uah')</div>
                                            <div class="table-inner-list__size text-lowercase">{{$product->pivot->quantity}} @lang('custom::site.pcs')</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
