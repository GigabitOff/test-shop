<div class="lk-table-body" id="product-list-livewire">
    <table wire:ignore
           class="js-table lk-table-cart" id="cart-contents-table"
           data-show-toggle="true" data-toggle-column="last"  data-empty="@lang('custom::site.data_is_absent')">
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
            <tr class="table-line product-{{$product->cartUuid}}"
                data-id="{{$product->cartUuid}}"
                data-qty="{{$product->cartQuantity}}"
                data-cost="{{$product->cartCost}}"
                data-price="{{$product->price}}"
                data-weight="{{$product->weight}}"
                data-volume="{{$product->volume}}">
                <td class="cell-product-td">
                    <div class="cell-product">
                        <div class="cell-checkbox">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input checked-value"
                                       onclick="@this.setCheckProduct('{{$product->cartUuid}}', this.checked)"
                                       @if($product->cartChecked) checked @endif
                                       type="checkbox"/>
                                <label class="custom-control-label"></label>
                            </div>
                        </div>
                        @php([$url, $image] = $product->compactUrlImage())
                        <div class="cell-img"><img src="{{$image}}" alt="{{$product->name}}"/></div>
                        <div class="cell-title">
                            <a href="{{$url}}">{{$product->name}}</a>
                        </div>
                    </div>
                </td>
                <td><span>{{$product->articul}}</span></td>
                <td>
                    <span class="cell-price">
                        <span class="price-value">{{formatMoney($product->price)}}</span> @lang('custom::site.UAH').</span>
                </td>
                <td>
                    <div class="jq-number input-col">
                        <div class="jq-number__spin minus"></div>
                        <div class="jq-number__field">
                            <input class="input-col" type="number" value="{{$product->cartQuantity}}" min="1"
                                   onchange="@this.updateProductQuantity({{$product->id}}, this.value)"
                                   onclick="this.select();"/></div>
                        <div class="jq-number__spin plus"></div>
                    </div>
                </td>
                <td>
                    <span class="cell-price">
                        <span class="cost-value">{{formatMoney($product->cartCost)}}</span> @lang('custom::site.UAH').</span>
                </td>
                <td>
                    <span class="cell-weight">
                        <span class="weight-value">{{formatWeight($product->weight)}}</span> @lang('custom::site.kg')</span>
                    <span class="cell-size">
                        <span class="volume-value">{{formatVolume($product->volume)}}</span> @lang('custom::site.k.m.')</span>
                </td>
                <td>
                    <button class="js-remove-row cell-btn"
                            onclick="@this.removeProduct('{{$product->cartUuid}}');"
                            type="button">
                        <span class="ico_trash"></span>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
