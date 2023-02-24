<div class="swiper-wrapper">
    @foreach($products as $product)
        @php([$url, $image] = $product->compactUrlImage())
        <div class="swiper-slide">
            <div class="product-card add-product-order product-{{$product->id}}" data-id="{{$product->id}}">
                <div class="product-card__box">
                    <div class="js-del-item product-card__del ico_close"
                        onclick="Livewire.emit('eventRemoveProduct', '{{$product->cartUuid}}')"></div>
                    <div class="product-card__media">
                        <img src="{{$image}}" alt="{{$product->name}}"/>
                    </div>
                    <div class="product-card__title">
                        <a href="{{$url}}">{{$product->name}}</a>
                    </div>
                    <div class="product-card__bottom">
                        <div class="product-card__price text-lowercase">{{formatMoney($product->price)}} @lang('custom::site.uah')</div>
                        <div class="jq-number input-col">
                            <div class="jq-number__spin minus"></div>
                            <div class="jq-number__field">
                                <input class="input-col" type="number" data-id="{{$product->id}}"
                                       value="{{$product->cartQuantity}}" min="1"
                                       onchange="Livewire.emit('eventSetProductQuantity', {'product_id':{{$product->id}}, 'quantity': this.value, 'source': 'slider'})"
                                       onclick="this.select();"/></div>
                            <div class="jq-number__spin plus"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
