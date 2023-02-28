<table>
    <thead>
    <tr>
        <th>
            <div class="d-flex align-items-center">
                <label class="check js-select-all">
                    <input class="check__input" type="checkbox"
                           onchange="Livewire.emit('eventCheckAllChanged', this.checked)"
                    @if($checkAll) checked @endif />
                    <span class="check__box"></span><span
                            class="check__txt"></span></label>
                <span>@lang('custom::site.Selected products')</span>
            </div>
        </th>
        <th data-breakpoints="xs">@lang('custom::site.availability')</th>
        <th data-breakpoints="xs">@lang('custom::site.Price')</th>
        <th data-breakpoints="xs sm md">@lang('custom::site.Number')</th>
        <th data-breakpoints="xs sm md">@lang('custom::site.sum')</th>
        <th data-breakpoints="xs sm md"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $cartProduct)
        <tr>
            <td>
                <div class="d-flex align-items-center">
                @if($cartProduct->availability)
                    <label class="check">
                        <input class="check__input" type="checkbox"
                        onclick="document.cartProduct.setCheck('{{$cartProduct->cartUuid}}', this.checked)"
                        @if($cartProduct->cartChecked) checked @endif/>
                        <span class="check__box"></span>
                        <span class="check__txt"></span>
                    </label>
                @else
                    <label class="check"></label>
                @endif
                    <div class="table-product-card">
                        @if($cartProduct->availability)
                        <div class="table-product-card__img">
                            @if($cartProduct->images->isNotEmpty())
                                @foreach($cartProduct->images as $key_image => $image)
                                    @if($key_image == 0 )
                                        <img src="{{\Storage::disk('public')->url($image->url)}}"
                                             alt="{{$cartProduct->name}}">
                                    @endif
                                @endforeach
                            @else
                                <img src="{{fallbackProductImageUrl($cartProduct->imagefullUrl)}}"
                                     alt="{{$cartProduct->name}}">
                            @endif
                        </div>
                        @else
                            <div class="product-card__badges">
                                <span class="product-card__label not">
                                  @lang('custom::site.availability_absent')
                                </span>
                            </div>
                            <div class="table-product-card__img">
                            <img style="filter: grayscale(1);"
                                 src="{{fallbackImageUrl('app.fallback_image.cart', '')}}"
                                 alt="">
                            </div>
                        @endif
                        <div class="table-product-card__desc"><span
                                    class="table-product-card__art">№{{$cartProduct->articul}}</span><a
                                    class="table-product-card__title"
                                    href="{{route('products.show', $cartProduct->slug)}}">
                                @foreach ($cartProduct->translations as $item_d)
                                    @if($item_d->locale == app()->getLocale())
                                        {!!$item_d->name !!}
                                    @endif
                                @endforeach
                            </a>

                            <div style="cursor: pointer" class="table-product-card__others-product"
                                 onclick="Livewire.emit('eventDeferredsGoods',
                                 {{$cartProduct->id}}, '{{$cartProduct->cartQuantity}}',
                                         '{{$cartProduct->cartUuid}}')">
                                @lang('custom::site.save_for_later')
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="status {{$cartProduct->availabilityCss}}">
                    <span class="circle"></span>
                    <span>{{$cartProduct->availabilityText}}</span>
                </div>
            </td>
            <td>
                <span class="big">{!! formatNbsp(formatMoney($cartProduct->price - $cashbackUsed) . ' ' . __('custom::site.UAH')) !!}</span>
                <span class="small">{!! formatNbsp(formatMoney($cartProduct->price_retail) . ' ' . __('custom::site.UAH')) !!}</span>
            </td>
            <td class="text-center">
                <div class="counter">
                    <div class="counter__btn minus"></div>
                    <div class="counter__field">
                        <input type="number" value="{{$cartProduct->cartQuantity}}" min="1"
                        onchange="document.cartProduct.changeQuantity(this,
                        '{{$cartProduct->cartUuid}}')"/>
                    </div>
                    <div class="counter__btn plus"></div>
                </div>
            </td>
            <td>
                <span class="big">{!! formatNbsp(formatMoney($cartProduct->cartCost - $cashbackUsed) . ' ' . __('custom::site.UAH')) !!}</span>
                <span class="small">{!! formatNbsp(formatMoney($cartProduct->totalPriceRetail) . ' ' . __('custom::site.UAH')) !!}</span>
            </td>
            <td class="text-end">
                <button class="button-delete ico_trash" type="button"
                        onclick="document.cartProduct.remove('{{$cartProduct->cartUuid}}');">
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
