<section class="section-brands">
    @if($brands->isNotEmpty())
        <div class="container-xl">
            <div class="section-header">
                <h3 class="section-title" data-aos="fade-up"
                    data-aos-duration="300">@lang('custom::site.Our brands')</h3>
            </div>
            <div class="section-content">
                <div class="brands-slider js-brands-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach ($brands as $item)
                                <div class="swiper-slide" data-aos="fade-right" data-aos-delay="200"
                                     data-aos-duration="300">
                                    <div class="brand-card">
                                        <a class="brand-card__link"
                                           href="{{ route('brands.show', [$item->slug])}}">
                                            <div class="brand-card__media">
                                                <img src="{{ $item->imageSrc }}" alt="{{ $item->title }}">
                                            </div>
                                            <div class="brand-card__desc">
                                                <span>{{$item->title}}</span>
                                                <button class="button-more-brands"
                                                        type="button">@lang('custom::site.more')</button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if($brands->count() > 5)
                        <div class="swiper-nav --section-slider-nav" data-aos="fade-down" data-aos-delay="1500"
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
