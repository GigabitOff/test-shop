<table>
    <thead>
    <tr>
        <th>@lang('custom::site.product')</th>
        <th data-breakpoints="xs">@lang('custom::site.article')</th>
        <th data-breakpoints="xs">@lang('custom::site.price')</th>
        <th data-breakpoints="xs">@lang('custom::site.quantity')</th>
        <th data-breakpoints="xs">@lang('custom::site.total_sum')</th>
        <th data-breakpoints="xs">@lang('custom::site.status')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        @php([$url, $image] = $product->compactUrlImage())
        <tr>
            <td class="cell-product-td">
                <div class="cell-product">
                    <div class="cell-img"><img src="{{$image}}" alt="product"/></div>
                    <div class="cell-title">
                        <a href="{{$url}}">{{$product->name}}</a>
                        @if($product->isPersonalOffer)
                            <br>
                            <b>@lang('custom::site.personal_offer'): {{$product->personalOfferId1c}}</b>
                        @endif
                    </div>
                </div>
            </td>
            <td><a href="{{$url}}">№ {{$product->articul}}</a></td>
            <td><span class="cell-price">{{formatMoney($product->orderPrice)}} @lang('custom::site.uah').</span></td>
            <td><span>{{$product->orderQuantity}} @lang('custom::site.pcs').</span></td>
            <td><span class="cell-price">{{formatMoney($product->orderCost)}} @lang('custom::site.uah').</span></td>
            <td>
                <span class="call-stat @if(!$product->availability) waiting @endif">
                    <span class="ico_check"></span>
                    @if($product->availability)
                        <span>@lang('custom::site.availability_exist')</span>
                    @else
                        <span>@lang('custom::site.availability_waiting')</span>
                    @endif
                </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
