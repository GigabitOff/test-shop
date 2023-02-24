<div class="hero-slider js-hero-slider" data-aos="fade-up">
    <div class="swiper">
        <div class="swiper-wrapper">
            @if(count($slide_banners)<=0)
                <div class="swiper-slide">
                    <div class="hero-banner">
                        <div class="hero-banner__desc">
                            <div data-aos="fade-right" data-aos-delay="200">
                                <h3 class="hero-banner__title" data-swiper-parallax-x="100"></h3>
                            </div>
                            <div data-aos="fade-left" data-aos-delay="400">
                                <p class="hero-banner__text" data-swiper-parallax-x="-100"></p>
                            </div>
                            <div class="hero-banner__more"><a class="button" href=""></a></div>
                        </div>
                        <div class="hero-banner__img" ></div>
                    </div>
                </div>
            @endif
            @foreach($slide_banners as $banner)
                <div class="swiper-slide">
                    <div class="hero-banner">
                        <div class="hero-banner__desc">
                            <div data-aos="fade-right" data-aos-delay="200">
                                <h3 class="hero-banner__title" data-swiper-parallax-x="100">{!! $banner->title !!}</h3>
                            </div>
                            <div data-aos="fade-left" data-aos-delay="400">

                                <p class="hero-banner__text" data-swiper-parallax-x="-100">{{$banner->description}}</p>
                            </div>
                            <div class="hero-banner__more"><a class="button" href="{{$banner->url}}">@lang('custom::site.Read more')</a></div>
                        </div>
                        @if($banner->image)

                            <div class="hero-banner__img" style="background-image: url({{\Storage::disk('public')->url($banner->image)}})"></div>
                        @else
                            <div class="hero-banner__img" style="background-image: url(/assets/img/bg_hero-banner.jpg)"></div>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
        <div class="swiper-nav" data-aos="fade-right" data-aos-delay="800">
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</div>



