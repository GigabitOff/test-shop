{{-- Related Product Livewire --}}
@if($productsRelated->isNotEmpty())
    <div class="product-full-box --related-products">
        <div class="product-full-box__head">
            <div class="product-full-box__title">@lang('custom::site.Related products')</div>
        </div>
        <div class="product-full-box__body">
            <div class="js-related-products related-products">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach($productsRelated as $prodRelated)
                            <div class="swiper-slide">
                                <x-product-card
                                    cardClasses="--small"
                                    :product="$prodRelated"
                                />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-nav --section-slider-nav">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
@endif
