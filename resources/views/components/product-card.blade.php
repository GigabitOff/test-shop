<div class="product-card {{$cardClasses ?? ''}}">
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
            @php($productPriceField = App\Models\Product::getPriceField(null, $product->price_sale,  $product->price_wholesale))
            <div class="product-card__price">
                <del>{!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!}</del>
                {!! formatNbsp(formatMoney($product->$productPriceField) . ' ₴') !!}
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
                        <a class="button-outline button-small"
                           onclick="Livewire.emit('eventCartAddProduct', {'product_id' : {{$product->id}}, 'show_notification':1, 'price_added' : {{$product->price}}, 'quantity': $(this).closest('.product-card__bottom').find('.counter input')[0].value})"
                           href="javascript:void(0);">
                            @lang('custom::site.Buy')
                        </a>
                    @else
                        @auth()
                            <a class="button-outline button-small"
                               onclick="Livewire.emit('eventAddFavouriteItem', {'product_id' : {{$product->id}}, 'show_notification':1})"
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
            @if($showIntro)
                <div class="product-card__intro">
                    <div class="product-card__intro-inner">
                        {{$product->short_description}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
