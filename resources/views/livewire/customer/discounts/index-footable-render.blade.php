<table>
    <thead>
    <tr>
        <th>@lang('custom::site.product')</th>
        <th data-breakpoints="xs">@lang('custom::site.category')</th>
        <th data-breakpoints="xs">@lang('custom::site.price')</th>
        <th class="text-xl-center" data-breakpoints="xs sm md">@lang('custom::site.quantity')</th>
        <th data-breakpoints="xs sm md">@lang('custom::site.status')</th>
        <th class="w-1" data-breakpoints="xs sm md"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>
                <div class="table-product-card">
                    <div class="table-product-card__img">
                        <img src="{{fallbackProductImageUrl($product->mainImage->fullUrl ?? '')}}" alt="product image">
                    </div>
                    <div class="table-product-card__desc">
                        <span class="table-product-card__art">№ {{$product->articul}}</span>
                        <a class="table-product-card__title"
                           href="{{route('products.show', $product->slug)}}">
                            {{$product->name}}</a>
                    </div>
                </div>
            </td>
            <td>
                <span>{{$product->exCategoryName}}</span>
            </td>
            <td>
                <span
                    class="text-lowercase">{{formatNbsp(formatMoney($product->offerPrice))}} @lang('custom::site.uah')</span>
                <span
                    class="small text-lowercase">{{formatNbsp(formatMoney($product->offerPrice))}} @lang('custom::site.uah')</span>
            </td>
            <td class="text-xl-center">
                <div class="counter">
                    <div class="counter__btn minus"></div>
                    <div class="counter__field">
                        <input type="number" value="1" min="1"
                               max="{{$product->quantity}}"
                               onchange="$(this).closest('tr').find('.button.add-to-cart').attr('data-qty', this.value)"
                               onclick="this.select();"/>
                    </div>
                    <div class="counter__btn plus"></div>
                </div>
            </td>
            <td>
                <div class="status {{$product->exAvailabilityCss}}">
                    <span class="circle"></span>
                    <span>{{$product->exAvailabilityText}}</span>
                </div>
            </td>
            <td class="text-end w-1">
                <button class="button-accent add-to-cart"
                        data-qty="1"
                        onclick="Livewire.emit('eventAddProductToCart',{{$product->id}}, {{$product->personal_offer_id}}, $(this).attr('data-qty'))"
                        type="button">@lang('custom::site.Buy')</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
