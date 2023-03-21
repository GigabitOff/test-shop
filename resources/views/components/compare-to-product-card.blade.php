<div class="compare-item">
    <div class="compare-item__head">
        <div class="compare-item__box">
            <div class="compare-item__media">
                <div class="compare-item__action">
                    <div class="compare-item__label {{$product->availabilityCss}}">{{$product->availabilityText}}</div>
                    <div class="compare-item__brand">
                        @if($product->brandImageUrl)
                            <img src="{{$product->brandImageUrl}}" alt="brand photo">
                        @endif
                    </div>
                </div><img src="{{$product->mainImageUrl}}" alt="{{$product->name}}"/>
            </div>
            <div class="compare-item__info">
                <div class="compare-item__number">№ {{$product->articul}}</div>
                <div class="compare-item__title"><a href="{{route('products.show', $product->slug)}}">{{$product->name}}</a></div>
                {{--  Block for determining the type and type of prices in accordance with the type of user.--}}
                @php($productPriceField = App\Models\Product::getPriceFieldWithParams(null, $product->price_sale,  $product->price_wholesale , $product->price_sale_show))
                <div class="compare-item__price">
                    @if ($product->price_sale_show != 0 and $product->price_wholesale == 0 or $product->price_sale_show == 0 and $product->price_wholesale != 0 or $product->price_sale_show != 0 and $product->price_wholesale != 0)
                        <span>
                        <?php $user = $user ?? auth()->user(); ?>
                            @if (is_object($user) && $user->is_founder != 0)
                                @if ($product->price_sale_show == 0 and $product->price_wholesale != 0)
                                    <span style="color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </span>
                                @else
                                    <s style="text-decoration: line-through; color: #9f041b; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @endif
                            @else
                                @if (!is_object($user) and $product->price_sale_show != 0 and $product->price_sale != 0)
                                    <s style="text-decoration: line-through; color: #9f041b; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @else
                                    <s style="text-decoration: line-through; color: #9f041b; font-size: 17px;"></s>
                                @endif
                                @if (is_object($user) and $product->price_sale_show != 0)
                                    <s style="text-decoration: line-through; color: #9f041b; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @endif
                            @endif
                    </span>
                    @elseif($product->price_wholesale == 0 and $product->price_sale_show == 0 )
                        <span style="color: grey; font-size: 17px;"></span>
                    @endif
                    <span class="big">{!! formatNbsp(formatMoney($product->{$productPriceField}) . ' ₴') !!}</span>
                </div>
                <div class="compare-item__sub-price">&nbsp;</div>
                <div class="compare-item__btn"><button class="js-add-cart button-outline button-small" type="button">Придбати</button></div>
            </div>
        </div>
    </div>
    <div class="compare-item__body">
        <ul class="compare-item__list">
            @foreach($attrs as $id => $name)
                <li class="filtered attribute-{{$id}}"
                    data-attribute="{{$id}}">
                    <div class="compare-item__item"><span
                            class="lbl">{{$name}}</span><span
                            class="value">{{$this->productAttributeValuesLine($product, $id)}}</span></div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
