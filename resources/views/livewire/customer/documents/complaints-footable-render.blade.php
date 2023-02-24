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
            <td class="w-10">
                <div data-label="№ / @lang('custom::site.date')">
                    <a class="cell-number" href="{{route('customer.orders.show', $order->id)}}">№ {{$order->id}}</a>
                    <span class="cell-date">@lang('custom::site.from') {{formatDate($order->created_at)}}</span></div>
            </td>
            <td class="w-10 text-center">
                <div data-label="@lang('custom::site.date_shipment')"><span>{{formatDate($order->date_delivery)}}</span>
                </div>
            </td>
            <td class="w-10 text-md-center">
                <div data-label="@lang('custom::site.order')">
                    <strong class="cell-price">{{formatMoney($order->total)}} @lang('custom::site.uah').</strong>
                    <span
                        class="cell-size">{{$order->total_quantity}} {{Str::lower(numericCasesLang($order->total_quantity, 'custom::site.product'))}}</span>
                </div>
            </td>
            <td class="w-50">
                <div data-label="@lang('custom::site.delivery')"><img src="/assets/img/{{$order->deliveryIcon}}"
                                                                      alt="image"></div>
            </td>
            <td class="text-end w-1"></td>
            <td>
                <div class="table-inner">
                    @foreach($order->documentComplaints as $document)
                        @php
                            $product = $document->products->first();
                            $category = $product->categories->first();
                            $url = $category ? route('catalog.show_single', ['slug'=>$category->seoSlug]) : 'javascript:void(0);';
                            $target = $category ? '_blank' : '';
                        @endphp
                        <div class="table-inner__row">
                            <div class="table-inner__cell">
                                <div>
                                    <span class="cell-number">№ {{$product->articul}}</span>
                                    <a class="cell-title"
                                       href="{{$url}}"
                                       target="{{$target}}">{{$product->name}}</a>
                                </div>
                                <div>
                                    <strong class="text-lowercase">{{formatMoney($product->pivot->price_nds)}}
                                        @lang('custom::site.uah').</strong>
                                </div>
                            </div>
                            <div class="table-inner__cell">
                                <div class="table-inner__product">
                                    <div class="table-inner__product-img">
                                        @php($imageUrls = $document->imageUrls)
                                        <a href="{{$imageUrls->first()}}"
                                           data-count="{{$imageUrls->count()}}"
                                           data-fancybox="gallery-{{$document->id}}"><img
                                                src="{{$imageUrls->first()}}" alt="image"></a>
                                        <div hidden>
                                            @foreach($imageUrls->slice(1) as $url)
                                                <a href="{{$url}}" data-fancybox="gallery-{{$document->id}}"></a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="table-inner__product-txt">{{$document->response}}
                                    </div>
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
                    @endforeach
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
