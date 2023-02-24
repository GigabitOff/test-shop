<x-app-layout body-classes="page-main">
    <main class="page-main page-news">
        <section class="section-banner --mobile">
            <div class="container-xl">
                <div class="banner" data-aos="zoom-in" data-aos-duration="300">
                    <div class="banner__box">
                        <div class="banner__desc" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                            <div class="banner__top">
                                <a class="button-back" href="/news">@lang('custom::site.Come back')<i class="ico_angle-left"></i></a>
                                <span>{{(isset($page->seo_h1) AND $page->seo_h1) != '' ? $page->seo_h1 : $page->title}}</span>
                            </div>
                            <h3 class="banner__title">{{ $data->title }}</h3>
                            <p class="banner__text">{{ strip_tags($data->body) }}</p>
                        </div>
                        <div class="banner__media" style="background-image: url({{ \Storage::disk('public')->url($data->image) }})"></div>
                    </div>
                </div>
            </div>
        </section>
        <div class="page-content">
            <div class="container-xl">
                <div class="row g-5 pt-3" data-aos="fade-up" data-aos-delay="400" data-aos-duration="500">
                    <div class="col-xl-8 offset-xl-2">
                        {!! $data->body !!}
                    </div>
                </div>
            </div>
        </div>
        <section class="others-article">
            <div class="container-xl">
                <div class="section-header">
                    <h3 class="section-title" data-aos="fade-up" data-aos-duration="500">@lang('custom::site.other_news')</h3>
                </div>
                <div class="section-content">
                    <div class="js-others-article">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($news as $item)
                                    <div class="swiper-slide" data-aos="fade-right" data-aos-delay="100" data-aos-duration="500">
                                        <div class="news-card --horisontal">
                                            <div class="news-card__box">
                                                <div class="news-card__media"><a href="{{ route('news.show', $item->slug) }}"><img src="{!! \Storage::disk('public')->url($item->image_small) !!}" alt="" /></a></div>
                                                <div class="news-card__info">
                                                    <div class="news-card__title"><a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a></div>
                                                    <div class="news-card__text">
                                                        <p>{{ strip_tags($item->body) }}</p>
                                                    </div>
                                                    <div class="news-card__bottom">
                                                        <div class="news-card__date">{{ $item->created_at->format('d/m/Y') }}</div>
                                                        <div class="news-card__btn"><a class="button-more" href="{{ route('news.show', $item->slug) }}"></a></div>
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
