<table>
    <thead class="hidden-mobile">
    <tr>
        <th>@lang('custom::site.photo')</th>
        <th>@lang('custom::site.Name')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.category')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.status')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.price')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.article')</th>
        <th class="text-center" data-breakpoints="xs">@lang('custom::site.quantity')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        @php([$url, $image, $category] = $product->compactUrlImage())
        <tr>
            <td class="cell-img">
                <img src="{{$image}}" alt="product"/>
            </td>
            <td class="cell-title">
                <a href="{{$url}}">{{$product->name}}</a>
            </td>
            <td class="text-right text-md-center">
                <strong>{{$category->name ?? ''}}</strong>
            </td>
            <td class="text-right text-md-center">
                <span class="call-stat @if(!$product->availability) waiting @endif">
                    <span class="ico_check"></span>
                    @if($product->availability)
                        <span>@lang('custom::site.availability_exist')</span>
                    @else
                        <span>@lang('custom::site.availability_waiting')</span>
                    @endif
                </span>
            </td>
            <td class="text-right text-md-center"><span class="text-lowercase">{{formatMoney($product->price)}} @lang('custom::site.uah').</span></td>
            <td class="text-right text-md-center"><span>№ {{$product->articul}}</span></td>
            <td class="text-right text-md-center">
                <div class="jq-number input-col">
                    <div class="jq-number__spin minus"></div>
                    <div class="jq-number__field">
                        <input class="input-col"
                               type="number" data-id="{{$product->id}}"
                               value="{{$product->cartQuantity}}" min="0"
                               onchange="Livewire.emit('eventSetProductQuantity', {'product_id': {{$product->id}}, 'quantity': this.value, 'source': 'table'})"
                               onclick="this.select();"/></div>
                    <div class="jq-number__spin plus"></div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
