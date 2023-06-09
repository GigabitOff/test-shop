<div class="product-card {{$cardClasses ?? ''}}  @if(!isset($product->mainImageSecond->url)) product-card--single @endif">
    <div class="product-card__box {{$product->availabilityCss}}">
        <div class="product-card__media">
            <div class="product-card__badges">
                <span class="product-card__label {{$product->availabilityCss}}">
                  {{$product->availabilityText}}
                </span>
                {{--                <div class="product-card__badge product-card__badge-new">--}}
                {{--                    <div class="product-card__badge-button ico_star"></div>--}}
                {{--                    <div class="product-card__badge-dropdown">--}}
                {{--                        <div class="product-card__badge-icon ico_star"></div>--}}
                {{--                        <div class="product-card__badge-title">Новинка</div>--}}
                {{--                        <div class="product-card__badge-content">--}}
                {{--                            <p>There are many variations of passages lorem Ipsum available, but the majority alteration in some form, by injected humour randomised words which don't look even believable. </p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <span class="product-card__brand">
                @if($product->brandImageUrl)
                    <img src="{{$product->brandImageUrl}}" alt="brand photo">
                @endif
            </span>
            <a class="product-card__link" href="{{route('products.show', $product->slug)}}">
                <img src="{{$product->mainImageUrl}}" alt="{{$product->name}}"/>
                @if(isset($product->mainImageSecond->url))
                <div class="product-card__link-hover"><img src="{{ \Storage::disk('public')->url($product->mainImageSecond->url ?? '') }}" alt="{{ $product->name }}"></div>
                @endif
            </a>
        </div>
        <div class="product-card__info">
            <ul class="product-card__colors">
                @foreach($product->colorVariations as $variation)
                    @continue($loop->iteration > 3)
                    <li>
                        <a href="{{ route('products.show', [$variation->slug])}}">
                            <span style="background-color:{{$variation->color ?? ''}}"></span>
                        </a>
                    </li>
                @endforeach
                @if($product->colorVariations->count() > 3)
                    <li>+{{$product->colorVariations->count() - 3}}</li>
                @endif
            </ul>
            <div class="product-card__info-grid">
                <span class="product-card__number">№ {{$product->articul}}</span>
                @if($product->categoryName)
                    <span class="product-card__category">{{$product->categoryName}}</span>
                @endif
            </div>
            <h4 class="product-card__title">
                <a href="{{route('products.show', $product->slug)}}">
                    {{$product->name}}
                </a>
            </h4>
            <div class="product-card__brand">
                @if($product->brand)
                    {{$product->brand->title}}
                @endif
            </div>
            <div class="product-card__sizes">
                <ul>
                    @foreach($product->cardAttrVariations as $variation)
                        @continue($loop->iteration > 3)
                        <a href="{{ route('products.show', [$variation->slug])}}#specification">
                            <li><span>{{$variation->cardAttrValue }}</span></li>
                        </a>
                    @endforeach
                    @if($product->cardAttrVariations->count() > 3)
                        <li>+{{$product->cardAttrVariations->count() - 3}}</li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="product-card__bottom">
            <div class="js-add-compare product-card__compare
                @if(comparisons()->isExistProduct($product->id)) is-active @endif"
                 onclick="Livewire.emit('eventToggleComparisons', {'product_id' : {{$product->id}} })">
                <div class="ico_compare"></div>
            </div>
          {{--  Block for determining the type and type of prices in accordance with the type of user.--}}
            @php($productPriceField = App\Models\Product::getPriceFieldWithParams(null, $product->price_sale,  $product->price_wholesale , $product->price_sale_show))
            <div class="product-card__price" style="display: block;">
                @if ($product->price_sale_show != 0 and $product->price_wholesale == 0 or $product->price_sale_show == 0 and $product->price_wholesale != 0 or $product->price_sale_show != 0 and $product->price_wholesale != 0)
                    <span>
                        <?php $user = $user ?? auth()->user(); ?>
                        @if (is_object($user) && $user->is_founder != 0)
                            @if ($product->price_sale_show == 0 and $product->price_wholesale != 0)
                                <span>{!! formatNbsp(formatMoney($product->{$productPriceField}) . ' ₴') !!}</span>
                                <div class="product-card__sub-price">
                                    <span style="color: #6c757d;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </span>
                                </div>
                            @else
                                <del> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </del>
                                <span class="big">  {!! formatNbsp(formatMoney($product->{$productPriceField}) . ' ₴') !!}</span>
                            @endif
                        @else
                            @if (!is_object($user) and $product->price_sale_show != 0 and $product->price_sale != 0)
                                <del> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </del>
                            @endif
                            @if (is_object($user) and $product->price_sale_show != 0)
                                    <del> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </del>
                            @endif
                            <span class="big">  {!! formatNbsp(formatMoney($product->{$productPriceField}) . ' ₴') !!}</span
                         @endif
                    </span>
                @elseif($product->price_wholesale == 0 and $product->price_sale_show == 0 )
                    <span class="big">  {!! formatNbsp(formatMoney($product->{$productPriceField}) . ' ₴') !!}</span>
                @endif
            </div>
            <div class="product-card__grid">
                <div class="product-card__counter">
                    <div class="counter">
                        <div class="counter__btn minus"></div>
                        <div class="counter__field">
                            <input type="input-col js-numeric"
                                   min="{{$product->multiplicity}}"
                                   @if($product->maxStock)
                                       max="{{$product->maxStock}}"
                                   @endif
                                   value="{{$product->multiplicity}}"/>
                        </div>
                        <div class="counter__btn plus"></div>
                    </div>
                </div>
                <div class="product-card__btn">
                    @if($product->can_be_sold)
                        <?php $price = $product->price ?? 0;  ?>
                        <a class="button-outline button-small"
                           onclick="Livewire.emit('eventCartAddProduct', {'product_id': {{$product->id}}, 'show_notification':1, 'price_added': {{$price}}, 'quantity': $(this).closest('.product-card__bottom').find('.counter input')[0].value})"
                           href="javascript:void(0);">
                            @lang('custom::site.Buy')
                        </a>
                    @else
                        @auth()
                            <a class="button-outline button-small"
                               onclick="Livewire.emit('eventDeferredsGoodsCatalog',{{$product->id}},1)"
                               href="javascript:void(0);">
                                @lang('custom::site.add to waiting list')
                            </a>
                        @endauth
                        @guest()
                            <span class="button-small">
                                @lang('custom::site.availability_absent')
                            </span>
                        @endguest()
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .product-card__box:hover {
        height: 100%;
    }
    .product-card {
        height: 425px;
    }
    .product-full-box__body .product-card {
        height: 327px;
    }
    .product-card__brand {
        min-height: 16px;
    }
    .product-card.--small .product-card__bottom {
        min-height: unset;
    }
    div.product-card:not(.--small) div.product-card__brand {
        display:none
    }
    div.product-card.--small span.product-card__brand{
        display:none
    }
    .product-card__sub-price {
        justify-content: center;
        font-weight: 400;
    }
</style>
