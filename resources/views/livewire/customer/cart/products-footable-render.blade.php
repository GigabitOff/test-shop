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
            {{-- Block for determining the type and type of prices in accordance with the type of user.--}}
            @php($productPriceField = App\Models\Product:: getPriceFieldWithParams(null, $cartProduct->price_sale,  $cartProduct->price_wholesale, $cartProduct->price_sale_show))
            <td>
                <span class="big">{!! formatNbsp(formatMoney($cartProduct->$productPriceField - $cashbackUsed) .  ' ₴') !!}</span>
                @if ($cartProduct->price_sale_show != 0 and $cartProduct->price_wholesale == 0 or $cartProduct->price_sale_show == 0 and $cartProduct->price_wholesale != 0 or $cartProduct->price_sale_show != 0 and $cartProduct->price_wholesale != 0)
                    <span>
                        <?php $user = $user ?? auth()->user(); ?>
                        @if (is_object($user) && $user->is_founder != 0)
                            @if ($cartProduct->price_sale_show == 0 and $cartProduct->price_wholesale != 0)
                                <span style="color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($cartProduct->price_rrc) . ' ₴') !!} </span>
                            @else
                                <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($cartProduct->price_rrc) . ' ₴') !!} </s>
                            @endif
                        @else
                            @if (!is_object($user) and $cartProduct->price_sale_show != 0 and $cartProduct->price_sale != 0)
                                <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($cartProduct->price_rrc ) . ' ₴') !!} </s>
                            @else
                                <s style="text-decoration: line-through; color: grey; font-size: 17px;"></s>
                            @endif
                            @if (is_object($user) and $cartProduct->price_sale_show != 0)
                                <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($cartProduct->price_rrc ) . ' ₴') !!} </s>
                            @endif
                        @endif
                            </span>
                @elseif($cartProduct->price_wholesale == 0 and $cartProduct->price_sale_show == 0 )
                    <span style="color: grey; font-size: 17px;"></span>
                @endif
            </td>
            <td class="text-center">
                <div class="counter">
                    <div class="counter__btn minus"></div>
                    <div class="counter__field">
                        <input type="number" value="{{$cartProduct->cartQuantity}}" min="0"
                               onchange="document.cartProduct.changeQuantity(this, '{{$cartProduct->cartUuid}}')"/>
                    </div>
                    <div class="counter__btn plus"></div>
                </div>
            </td>
            <td>
                <span class="big">{!! formatNbsp(formatMoney(($cartProduct->$productPriceField - $cashbackUsed) * $cartProduct->cartQuantity) .  ' ₴') !!}</span>
                @if ($cartProduct->price_wholesale != 0 and $cartProduct->price_sale_show == 0 or $cartProduct->price_sale != 0 and $cartProduct->price_sale_show != 0)
                    <span>
                          <?php $user = $user ?? auth()->user(); ?>
                        @if (is_object($user) && $user->is_founder != 0)
                            @if ($cartProduct->price_sale_show == 0 and $cartProduct->price_wholesale != 0)
                                <span style="color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($cartProduct->price_rrc * $cartProduct->cartQuantity) . ' ₴') !!} </span>
                            @else
                                <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($cartProduct->price_rrc) . ' ₴') !!} </s>
                            @endif
                        @else
                            @if (!is_object($user) and $cartProduct->price_sale_show != 0 and $cartProduct->price_sale != 0)
                                <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($cartProduct->price_rrc * $cartProduct->cartQuantity) . ' ₴') !!} </s>
                            @else
                                <s style="text-decoration: line-through; color: grey; font-size: 17px;"></s>
                            @endif
                            @if (is_object($user) and $cartProduct->price_sale_show != 0)
                                <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($cartProduct->price_rrc * $cartProduct->cartQuantity) . ' ₴') !!} </s>
                            @endif
                        @endif
                            </span>
                @elseif($cartProduct->price_wholesale == 0 and $cartProduct->price_sale_show == 0 )
                    <span style="color: grey; font-size: 17px;"></span>
                @endif
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
