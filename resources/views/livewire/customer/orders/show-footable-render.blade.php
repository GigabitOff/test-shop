<table>
    <thead class="hidden-mobile">
    <tr>
        <th>@lang('custom::site.product')</th>
        <th data-breakpoints="xs">@lang('custom::site.category')</th>
        @if($this->isShowProductReturningColumn())
            <th data-breakpoints="xs">@lang('custom::site.returning')</th>
        @endif
        <th data-breakpoints="xs sm md">@lang('custom::site.price')</th>
        <th data-breakpoints="xs sm md" class="text-xl-center">@lang('custom::site.quantity')</th>
        <th data-breakpoints="xs sm md">@lang('custom::site.total_sum')</th>
        @if($this->isShowProductStatusColumn())
            <th data-breakpoints="xs sm md">@lang('custom::site.product_status')</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>
                <div class="table-product-card">
                    <div class="table-product-card__img">
                        <img src="{{fallbackProductImageUrl($product->mainImage->fullUrl ?? '')}}" alt="image">
                    </div>
                    <div class="table-product-card__desc">
                        <span class="table-product-card__art">№ {{$product->articul}}</span><a
                            class="table-product-card__title"
                            href="{{route('products.show', $product->slug)}}">{{$product->name}}</a>
                    </div>
                </div>
            </td>
            <td><span>{{$product->categoryName}}</span></td>
            @if($this->isShowProductReturningColumn())
                <td>
                    <div class="return">
                        <div><i class="ico_checkmark"></i></div>
                        <div><span>Підтверджено</span><span class="small">23 шт / 27 шт</span></div>
                    </div>
                </td>
            @endif
            <td>
                <span class="big text-lowercase">
                    {!! formatNbsp(formatMoney($product->orderPrice) . ' ' . __('custom::site.uah')) !!}</span>
                <span class="small text-lowercase">
                    {!! formatNbsp(formatMoney($product->orderPrice) . ' ' . __('custom::site.uah')) !!}</span>
            </td>
            <td class="text-xl-center">
                <div class="counter">
                    <div class="counter__field">
                        <input type="number" value="{{$product->orderQuantity}}" disabled />
                    </div>
                </div>
            </td>
            <td>
                <span class="big text-lowercase">
                    {!! formatNbsp(formatMoney($product->orderCost) . ' ' . __('custom::site.uah')) !!}</span>
                <span class="small text-lowercase">
                    {!! formatNbsp(formatMoney($product->orderCost) . ' ' . __('custom::site.uah')) !!}</span>
            </td>
            @if($this->isShowProductStatusColumn())
                <td>
                    <div class="status {{$product->statusCss}}">
                        <span class="circle"></span>
                        <span>{{$product->statusText}}</span>
                    </div>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
