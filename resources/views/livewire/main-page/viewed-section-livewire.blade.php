<section class="section-products-view">
    @if($products->isNotEmpty())
        <div class="container-xl position-relative --decor">
            <div class="section-header">
                <h3 class="section-title" data-aos="fade-up"
                    data-aos-duration="300">@lang('custom::site.You have viewed')</h3>
            </div>
            <div class="section-content" wire:ignore>
                <div class="products-view js-products-view">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach($products as $product)
                                <div class="swiper-slide" data-aos="fade-right" data-aos-delay="200"
                                     data-aos-duration="300">
                                    <x-product-card :product="$product" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if($products->count() > 4)
                        <div class="swiper-nav --section-slider-nav --mobile" data-aos="fade-down" data-aos-delay="900"
                             data-aos-duration="500">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</section>
