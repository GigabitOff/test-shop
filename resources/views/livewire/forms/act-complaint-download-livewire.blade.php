<div class="modal-content">
    @if($isUploadLazyContent)
        <div class="modal-header">
            <h5 class="modal-title">@lang('custom::site.complaint_acts')
                <span>@lang('custom::site.on_project_domain')</span>
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span class="ico_close"></span>
            </button>
        </div>
        <div class="modal-body">
            <table>
                <thead>
                <tr>
                    <th>@lang('custom::site.product')</th>
                    <th class="text-center">@lang('custom::site.quantity')</th>
                    <th class="text-center">@lang('custom::site.sum')</th>
                    <th class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $document)
                    @php
                        $product = $document->products->first();
                        $category = $product->categories->first();
                        $url = $category ? route('catalog.show_single', ['slug'=>$category->id]) : 'javascript:void(0);';
                        $image = $product->imageFullUrl ?: $category->imageFullUrl;
                    @endphp
                    <tr>
                        <td><a class="d-block cell-number" href="{{$url}}">№ {{$product->articul}}</a><a
                                class="d-block cell-title" href="{{$url}}"><strong>{{$product->name}}</strong></a></td>
                        <td class="text-center"><span class="cell-price">1 @lang('custom::site.pcs').</span></td>
                        <td class="text-center">
                            <span class="cell-price">{{formatMoney($product->pivot->price_nds)}} @lang('custom::site.uah').</span>
                        </td>
                        <td class="text-center">
                            <a class="cell-btn" href="{{$document->fileUrl}}" target="_blank">
                                <span class="ico_downloads"></span>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-product-td" colspan="4">
                            <div class="cell-product">
                                <div class="cell-img"><img src="{{$image}}" alt="product"></div>
                                <div class="cell-desc"><strong>@lang('custom::site.Comment')</strong>
                                    <p>{{$document->response}}</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <div class="lk-table-total">
                <div class="lk-table-total__item">
                    <div class="lk-table-total__title">@lang('custom::site.total_sum')</div>
                    <div class="lk-table-total__value"><span class="lk-table-total__sum">{{formatMoney($document->totalCost)}} @lang('custom::site.uah').</span></div>
                </div>
                <div class="lk-table-total__item">
                    <div class="lk-table-total__title"></div>
                    @php($text = numericCasesLang($document->totalQuantity, 'custom::site.product') )
                    <div class="lk-table-total__value">
                        <span class="lk-table-total__col">{{$document->totalQuantity}} {{$text}}</span>
                    </div>
                </div>
            </div>
            <button class="button button-primary button-lg"
                    wire:click="downloadAll"
                    wire:loading.attr="disabled"
                    type="button">@lang('custom::site.upload_all')</button>
        </div>
    @endif
</div>
