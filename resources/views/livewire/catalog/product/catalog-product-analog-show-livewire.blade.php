<div class="slider-analogs-goods-box">
    <h3 class="section-title" data-aos="fade-right" data-aos-delay="1500" data-aos-duration="500">@lang('custom::site.Analogs of goods')</h3>
    <div class="section-content">
        <div class="slider-analogs-goods swiper-container">
            <div class="swiper-wrapper">
                @if(isset($category->analogCategoies) AND count($category->analogCategoies)>0)
                @foreach ($category->analogCategoies as $item)

                <div class="swiper-slide" data-aos="fade-up" data-aos-delay="1600" data-aos-duration="500">
                    <div class="product-card product-card--small">
                        <div class="product-card__box">
                            <div class="product-card__change-box">
                                <div class="product-card__change">
                                  <div class="product-card__media">
                                      @if($item->mainImage AND \Storage::disk('public')->exists($item->mainImage->url))

                                    <img src="{{\Storage::disk('public')->url($item->mainImage->url)}}" alt="{{ $item->name }}" />
                                    @elseif(isset($item->images[0]) AND \Storage::disk('public')->exists($item->images[0]->url))
                                        <img src="{{\Storage::disk('public')->url($item->images[0]->url)}}" alt="{{ $item->name }}" />
                                    @elseif(@$item->imageProducts() AND \Storage::disk('public')->exists(@$item->imageProducts()->url))
                                        <img src="{{\Storage::disk('public')->url($item->imageProducts()->url)}}" alt="{{ $item->name }}" />
                                    @else
                                    <img src="/assets/img/Foto.png" alt="{{ $item->name }}" />
                                    @endif

                                    </div>
                                  <div class="product-card__title">
                                      <a class="stretched-link" href="{{ route('catalog.show_single', [$item->slug])}}">
                                    {{ $item->name }}</a></div>
                                  <div class="product-card__specification">
                                    @if($item->attributes !== null)
                                    @foreach ($item->attributes->keyBy('id') as $item_atr)
                                        @php($values = $item_atr->terms->where('attribute_id', $item_atr->id)->pluck('value')->join(', '))
                                        <li>
                                            <span>{{ \Illuminate\Support\Str::limit($item_atr->name, 10) }}</span>
                                            <span>{{ \Illuminate\Support\Str::limit($values, 16) }}</span>
                                        </li>
                                    @endforeach
                                    @endif
                                  </div>
                                </div>
                            </div>
                            <div class="product-card__btn"><button class="button button-secondary js-add-cart" type="button">@lang('custom::site.Buy')</button></div>
                        </div>
                    </div>
                </div>
                @endforeach

                @endif

            </div>
            <div class="slider-nav" data-aos="fade-up" data-aos-delay="2200" data-aos-duration="500">
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
</div>
