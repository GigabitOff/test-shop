<div class="compare-item">
    <div class="compare-item__head">
        <div class="compare-item__box">
            <div class="compare-item__media">
                <div class="compare-item__label {{$product->availabilityCss}}">{{$product->availabilityText}}</div>
                <div class="compare-item__action">
                    <div class="btn-delete"
                         onclick="Livewire.emit('eventRemoveComparisonsItem', {'product_id' : {{$product->id}} })"><span class="ico_trash"></span></div>
                </div><img src="{{$product->mainImageUrl}}" alt="{{$product->name}}"/>
            </div>
            <div class="compare-item__info">
                <div class="compare-item__title"><a href="{{route('products.show', $product->slug)}}">{{$product->name}}</a></div>
                <div class="compare-item__price"><del>{!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!}</del>
                    {!! formatNbsp(formatMoney($product->price) . ' ₴') !!}</div>
            </div>
        </div>
    </div>
    <div class="compare-item__body">
        <ul class="compare-item__list">
            @foreach($attrs as $id => $name)
                <li class="filtered attribute-{{$id}}"
                    data-attribute="{{$id}}"
                    data-terms="{{$this->productAttributeIds($product)}}">
                    <div class="compare-item__item"><span
                            class="lbl">{{$name}}</span><span
                            class="value" data-term-id="{{$this->productAttributeValuesId($product, $id)}}">{{$this->productAttributeValuesLine($product, $id)}}</span></div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="compare-item__footer">
        <div class="product-card__counter">
            <div class="counter">
                <div class="counter__field">
                    <input type="input-col js-numeric"
                           min="{{$product->multiplicity}}"
                           @if($product->maxStock)
                           max="{{$product->maxStock}}"
                           @endif
                           value="{{$product->multiplicity}}"/>
                </div>
            </div>
        </div>
        @if($product->can_be_sold)
            <a class="button-outline button-small"
               onclick="Livewire.emit('eventCartAddProduct',{'product_id':{{$product->id}},'show_notification':1,'price_added':parseFloat('{{$product->price}}'),'quantity':$(this).closest('.compare-item__footer').find('.counter input').get(0).value})" href="javascript:void(0);">
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
