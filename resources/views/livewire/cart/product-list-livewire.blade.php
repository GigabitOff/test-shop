{{--<div wire:ignore class="lk-table-body" id="product-list-livewire">--}}
    <table wire:ignore
           class="js-table lk-table-cart" id="cart-contents-table"
           data-show-toggle="true" data-toggle-column="last">
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
        {{--        Строка заглушка как костыль для работы footble. --}}
        {{--        Footable по какой то причине, при обновлении таблицы через livewire,--}}
        {{--            подменяет первую строку данных на экзмпляр который был при загрузке страницы.    --}}
{{--        <tr style="display: none"></tr>--}}

        @foreach($products as $product)
            <tr class="table-line"
                data-id="{{$product->id}}"
                data-qty="{{$product->cartQuantity}}"
                data-cost="{{$product->cartCost}}"
                data-weight="{{$product->weight}}"
                data-volume="{{$product->volume}}">
                <td class="cell-product-td">
                    <div class="cell-product">
                        <div class="cell-checkbox">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input"
                                       data-id="{{$product->id}}"
                                       {{--                                       wire:model="checks"--}}
{{--                                       onclick="@this.updateChecks('{{$product->id}}')"--}}
                                       @if(!empty($checks[$product->id])) checked @endif
                                       type="checkbox"/>
                                <label class="custom-control-label"></label>
                            </div>
                        </div>
                        @php([$url, $image] = $product->compactUrlImage())
                        <div class="cell-img"><img src="{{$image}}" alt="{{$product->name}}"/></div>
                        <div class="cell-title">
                            <a href="{{$url}}">{{$product->name}}:{{$product->id}}</a>
                        </div>
                    </div>
                </td>
                <td><span>{{$product->code_1c}}</span></td>
                <td><span class="cell-price"><span class="price-value">{{formatMoney($product->price)}}</span> @lang('custom::site.UAH').</span></td>
                <td>
                    <div class="jq-number input-col">
                        <div class="jq-number__spin minus"></div>
                        <div class="jq-number__field">
                            <input class="input-col" type="number" value="{{$product->cartQuantity}}" min="1"
{{--                                   onchange="@this.updateProductQuantity({{$product->id}}, this.value)"--}}
                                   onclick="this.select();"/></div>
                        <div class="jq-number__spin plus"></div>
                    </div>
                </td>
                <td>
                    <span class="cell-price"><span class="cost-value">{{formatMoney($product->cartCost)}}</span> @lang('custom::site.UAH').</span>
                </td>
                <td>
                    <span class="cell-weight"><span class="weight-value">45</span> @lang('custom::site.kg')</span>
                    <span class="cell-size"><span class="volume-value">0,3</span> @lang('custom::site.k.m.')</span>
                </td>
                <td>
                    <button class="js-remove-row cell-btn"
{{--                            onclick="@this.removeProduct({{$product->id}})"--}}
                            type="button">
                        <span class="ico_trash"></span>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{--</div>--}}
