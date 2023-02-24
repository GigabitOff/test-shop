<x-app-layout body-classes="page-promotions">
    <main class="page-main page-promotions">
        <section class="section-banner --mobile">
            <div class="container-xl">
                <div class="banner" data-aos="zoom-in" data-aos-duration="300">
                    <div class="banner__box">
                        <div class="banner__desc" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                            <div class="banner__top">
                                <a class="button-back" href="/actions">@lang('custom::site.Come back')<i class="ico_angle-left"></i></a>
                                <span>{{(isset($page->seo_h1) AND $page->seo_h1) != '' ? $page->seo_h1 : $page->title}}</span>
                            </div>
                            <h3 class="banner__title">{{ $promotion->title }}</h3>
                            <p class="banner__text">{!! $promotion->description !!}</p>
                        </div>
                        <div class="banner__media" style="background-image: url({{ \Storage::disk('public')->url($promotion->image) }})"></div>
                    </div>
                </div>
            </div>
        </section>
        <div class="page-content">
            <div class="container-xl container-text">
                <div class="row g-5 mt-3" data-aos="fade-up" data-aos-delay="400" data-aos-duration="500">
                    <div class="col-12">
                        {!! $promotion->body !!}
                    </div>
                </div>
            </div>
        </div>
        <section class="section-products-view mt-0">
            <div class="container-xl position-relative">
                <div class="section-header">
                    <h3 class="section-title" data-aos="fade-up" data-aos-duration="500">@lang('custom::site.Products participating in the promotion')</h3>
                </div>
                <div class="section-content">
                    <div class="products-view js-products-view --promotion-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($promotion->products as $product)
                                <div class="swiper-slide" data-aos="fade-right" data-aos-delay="100" data-aos-duration="500">
                                    <x-product-card :product="$product" />
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-nav --section-slider-nav --mobile" data-aos="fade-left" data-aos-delay="800" data-aos-duration="500">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="others-article">
            <div class="container-xl">
                <div class="section-header">
                    <h3 class="section-title" data-aos="fade-up" data-aos-duration="500">@lang('custom::site.You have viewed')</h3>
                </div>
                <div class="section-content">
                    <div class="js-others-article">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($visits as $item)
                                    <div class="swiper-slide" data-aos="fade-right" data-aos-delay="100" data-aos-duration="500">
                                        <div class="news-card --horisontal">
                                            <div class="news-card__box">
                                                <div class="news-card__media">
                                                    <a href="{{ route('actions.show', $item->id)}}">
                                                        @if($item->image_small)
                                                            <img src="{{\Storage::disk('public')->url($item->image_small)}}" alt="" />
                                                        @else
                                                            <img src="{{fallbackBaseImageUrl('')}}" alt=""/>
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="news-card__info">
                                                    <div class="news-card__title">
                                                        <a href="{{ route('actions.show', $item->slug)}}">{{ $item->title }}</a>
                                                    </div>
                                                    <div class="news-card__text">
                                                        <p>{!! $item->description !!}</p>
                                                    </div>
                                                    <div class="news-card__bottom">
                                                        <div class="news-card__date">{{ \Carbon\Carbon::parse($item->date_start)->format('d/m/y')}} - {{ \Carbon\Carbon::parse($item->date_end)->format('d/m/y')}}</div>
                                                        <div class="news-card__btn"><a class="button-more" href="{{ route('actions.show', $item->slug)}}"></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-nav --section-slider-nav --mobile" data-aos="fade-left" data-aos-delay="500" data-aos-duration="500">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
