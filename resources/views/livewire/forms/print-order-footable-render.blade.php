<table>
    <thead>
    <tr>
        <th>№</th>
        <th>@lang('custom::site.product_name')</th>
        <th data-breakpoints="xs">Тип товару</th>
        <th data-breakpoints="xs">@lang('custom::site.quantity')</th>
        <th data-breakpoints="xs">@lang('custom::site.total')<br>
            <span class="with-sale-text text-lowercase">@lang('custom::site.with_sale')</span></th>
        <th data-breakpoints="xs">@lang('custom::site.shipment_br_warehouse')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr class="product-{{$product->id}}">
            <td><span>{{$loop->iteration}}</span></td>
            <td><a class="big" href="{{route('products.show', $product->slug)}}">{{$product->name}}</a></td>
            <td><span>Тип товару ??</span></td>
            <td><span>{{$product->orderQuantity}}</span></td>
            <td><span class="text-lowercase cost-value">{{formatNbsp(formatMoney($product->orderCost))}} @lang('custom::site.uah')</span></td>
            <td><span>Склад відвантаження ??</span></td>
        </tr>
    @endforeach
</table>
