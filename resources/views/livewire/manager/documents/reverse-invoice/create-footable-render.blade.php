<table>
    <thead class="hidden-mobile">
    <tr>
        <th>
            <div class="d-flex align-items-center">
                <div class="js-select-all custom-control custom-checkbox">
                    <input class="custom-control-input" id="select-all"
                           onchange="document.returnInvoice.setCheckedAll(this)"
                           type="checkbox">
                    <label class="custom-control-label"></label></div>
                <span class="ml-2">@lang('custom::site.product')</span>
            </div>
        </th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.article')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.price')</th>
        <th class="text-xl-center" data-breakpoints="xs sm md">@lang('custom::site.quantity')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.sum')</th>
        <th class="text-md-center" data-breakpoints="xs sm md">@lang('custom::site.status')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td class="cell-product-td">
                <div class="cell-product">
                    <div class="cell-checkbox">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input"
                                   data-product_id="{{$product->id}}"
                                   onchange="document.returnInvoice.setChecked(this)"
                                   @if($product->checked) checked @endif
                                   type="checkbox"/>
                            <label class="custom-control-label"></label></div>
                    </div>
                    @php([$url, $image] = $product->compactUrlImage())
                    <div class="cell-img"><img src="{{$image}}" alt="product"/></div>
                    <div class="cell-title"><a href="{{$url}}">{{$product->name}}</a></div>
                </div>
            </td>
            <td class="text-md-center"><span>№ {{$product->articul}}</span></td>
            <td class="text-md-center">
                <span class="cell-price text-lowercase">
                    {{formatMoney($product->orderPrice)}}
                    @lang('custom::site.uah').
                </span>
            </td>
            <td class="text-xl-center">
                <div class="jq-number input-col">
                    <div class="jq-number__spin minus"></div>
                    <div class="jq-number__field">
                        <input class="input-col" type="number"
                               value="{{$product->checkedQty ?: $product->orderQuantity}}"
                               min="1" max="{{$product->orderQuantity}}"
                               onchange="document.inputNumberCorrect(this);
                                   document.returnInvoice.setQuantity({{$product->id}}, this.value)"
                               onclick="this.select();"/>
                    </div>
                    <div class="jq-number__spin plus"></div>
                </div>
                {{--                <span>{{}}</span>--}}
            </td>
            <td class="text-md-center">
                <span class="cell-price text-lowercase">
                    {{formatMoney($product->orderCost)}}
                    @lang('custom::site.uah').
                </span>
            </td>
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
