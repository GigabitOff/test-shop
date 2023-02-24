<table>
    <thead>
    <tr>
        <th>@lang('custom::site.Name')</th>
        <th data-breakpoints="xs">@lang('custom::site.categories')</th>
        <th data-breakpoints="xs">@lang('custom::site.Producer')</th>
        <th data-breakpoints="xs">@lang('custom::site.utkved')</th>
        <th data-breakpoints="xs">@lang('custom::site.pcs_in_box')</th>
        <th data-breakpoints="xs">@lang('custom::site.availability')</th>
        <th data-breakpoints="xs sm md">@lang('custom::site.my_price') / @lang('custom::site.price_rrp')</th>
        <th class="text-xl-center" data-breakpoints="xs sm md">@lang('custom::site.quantity')</th>
        <th data-breakpoints="xs sm md"></th>
        <th data-breakpoints="xs sm md">@lang('custom::site.reserve')</th>
        <th data-breakpoints="xs sm md">@lang('custom::site.in_order')</th>
        <th class="w-1" data-breakpoints="xs sm md"></th>
    </tr>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>
                <div class="table-product-card --table-product-card-2 @if(!$product->isAvailabilityInStock()) end @endif">
                    <div class="table-product-card__img">
                        <img src="{{fallbackProductImageUrl($product->imageFullUrl)}}" alt="product image"></div>
                    <div class="table-product-card__desc">
                        <span class="table-product-card__art">
                            <i class="ico_copy"></i>№{{$product->articul}}</span>
                        <a class="table-product-card__title"
                           href="{{route('products.show', ['product' => $product->id])}}">{{$product->name}}</a></div>
                </div>
            </td>
            <td><span class="small black">{{$product->categories->first()->name ?? ''}}</span></td>
            <td><span class="small black">{{$product->brand->name ?? ''}}</span></td>
            <td><span class="small black">{{$product->uktved}}</span></td>
            <td><span>20</span></td>
            <td>
                <div class="status {{$product->availabilityCss}}">
                    <span class="circle"></span><span>{{$product->availabilityText}}</span></div>
            </td>
            <td>
                <span class="big text-lowercase">{{formatMoney($product->price)}} @lang('custom::site.uah')</span>
                <span class="small text-lowercase">{{formatMoney($product->price_rrc)}} @lang('custom::site.uah')</span>
            </td>
            <td class="text-xl-center">
                <div class="quantity-cont @if($product->cartQuantity) is-done @endif">
                    @if($product->isAvailabilityStockExist())
                        <input class="col"
                               data-id="{{$product->id}}"
                               onclick="this.select();"
                               onkeypress="if(event.keyCode===13){Livewire.emit('eventSetProductQuantity', {'product_id': {{$product->id}}, 'quantity': this.value, 'source': 'table'})}"
                               value="{{$product->cartQuantity}}">
                        @if($product->cartQuantity)
                            <div class="quantity-cont__badge"></div>
                        @endif
                    @else
                        <button class="col --waiting"
                                onclick="Livewire.emit('eventToggleFavourite', {'product_id':{{$product->id}}})"
                        >@lang('custom::site.to_favorites')</button>
                    @endif
                </div>
            </td>
            <td>
                <div class="button-info-group">
                    <div class="button-info --table --favorite">
                        @if($product->new)
                            <button class="button-info__button ico_star" type="button"></button>
    {{--                        <div class="button-info__dropdown">--}}
    {{--                            <div class="button-info__title">@lang('custom::site.novel')</div>--}}
    {{--                            <div class="button-info__content">--}}
    {{--                                <p>There are many variations of passages lorem Ipsum available.</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
                        @endif
                    </div>
                    @if($product->markdown)
                        <div class="button-info --table --discount">
                            <button class="button-info__button ico_discount" type="button"></button>
                            <div class="button-info__dropdown">
                                <div class="button-info__title">@lang('custom::site.markdown')</div>
                                <div class="button-info__content">
                                    <p>{!! $product->markdown_description !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </td>
            <td><span>{{$product->reservedCount}}</span></td>
            <td><span>{{$product->inOrderCount}}</span></td>
            <td class="w-1">
                <div class="button-info-group">
                    <div class="button-info --table --view">
                        <button class="button-info__button ico_view"
                                data-bs-target="#m-price" data-bs-toggle="modal"
                                type="button"></button>
                        <div class="button-info__dropdown">
                            <div class="button-info__title">@lang('custom::site.watch_price')</div>
                            <div class="button-info__content">
                                <p>There are many variations of passages lorem Ipsum available.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
