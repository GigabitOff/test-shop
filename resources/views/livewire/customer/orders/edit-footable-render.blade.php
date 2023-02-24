<table>
    <thead>
    <tr>
        <th>@lang('custom::site.Goods')</th>
        <th data-breakpoints="xs">@lang('custom::site.Article')</th>
        <th data-breakpoints="xs">@lang('custom::site.Price')</th>
        <th data-breakpoints="xs">@lang('custom::site.Number')</th>
        <th data-breakpoints="xs">@lang('custom::site.total')</th>
        <th data-breakpoints="xs">@lang('custom::site.Goods')</th>
        <th data-breakpoints="xs"></th>
    </tr>
    </thead>
    <tbody class="js-clear-box">
    @foreach($products as $product)
        @php([$url, $image] = $product->compactUrlImage())
        <tr class="table-line product-{{$product->orderUuid}}">
            <td class="cell-product-td">
                <div class="cell-product">
                    <div class="cell-img"><img src="{{$image}}" alt="{{$product->name}}"/></div>
                    <div class="cell-title">
                        <a href="{{$url}}">{{$product->name}}</a>
                        @if($controller->isProductBelongOffer($product->pivot))
                            <br>
                            <b>@lang('custom::site.personal_offer'): {{$product->orderOfferId1c}}</b>
                        @endif
                    </div>
                </div>
            </td>
            <td><span>{{$product->articul}}</span></td>
            <td>
                <span class="cell-price">
                    <span class="price-value">{{formatMoney($product->orderPrice)}}</span>
                    @lang('custom::site.UAH').
                </span>
            </td>
            <td>
                <div class="jq-number input-col">
                    <div class="jq-number__spin minus"></div>
                    <div class="jq-number__field">
                        <input class="input-col" type="number" value="{{$product->orderQuantity}}" min="1"
                               onchange="document.orderEditProduct.changeQuantity(this, '{{$product->orderUuid}}')"
                               @if($controller->isProductBelongOffer($product->pivot))
                               data-max="{{$product->orderOldQty}}"
                               @endif
                               onclick="this.select();"/></div>
                    <div class="jq-number__spin plus"></div>
                </div>
            </td>
            <td>
                <span class="cell-price"><span class="cost-value">{{formatMoney($product->orderCost)}}</span> @lang('custom::site.UAH').</span>
            </td>
            <td>
                <span class="cell-weight"><span class="weight-value">{{formatWeight($product->weight)}}</span> @lang('custom::site.kg')</span>
                <span class="cell-size"><span class="volume-value">{{formatVolume($product->volume)}}</span> @lang('custom::site.k.m.')</span>
            </td>
            <td>
                <button class="js-remove-row cell-btn"
                        onclick="document.orderEditProduct.remove('{{$product->orderUuid}}')"
                        type="button">
                    <span class="ico_trash"></span>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
