<x-app-layout body-classes="page-main">
    <main class="page-main page-news">
        @if($banners->first())
            <section class="section-banner --mobile">
                <div class="container-xl">
                    <div class="banner" data-aos="zoom-in" data-aos-duration="300">
                        <div class="banner__box">
                            <div class="banner__desc" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                                <div class="banner__top"><a class="button-back" href="/">@lang('custom::site.Come back')<i class="ico_angle-left"></i></a><span>{{(isset($page->seo_h1) AND $page->seo_h1) != '' ? $page->seo_h1 : $page->title}}</span></div>
                                <h3 class="banner__title">{!! $banners->first()->title !!}</h3>
                                <p class="banner__text">{!! $banners->first()->description ? $banners->first()->description : '' !!}</p>
                                <div class="banner__bottom">
                                    {!! ($banners->first()->link AND $banners->first()->link !='') ? '<div class="banner__btn"><a class="button-outline" href="'.$banners->first()->link.'">'.__('custom::site.Read more').'</a></div>' : ''!!}
                                </div>
                            </div>
                            <div class="banner__media" style="background-image: url({!! $banners->first()->image ?  \Storage::disk('public')->url($banners->first()->image) : '' !!})"></div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <div class="page-content">
            <div class="container-xl">
                <div class="row g-5 pt-3">
                    @foreach ($data as $item)
                        <div class="col-xl-4 col-md-6" data-aos="fade-right" data-aos-delay="400" data-aos-duration="500">
                            <div class="news-card">
                                <div class="news-card__box">
                                    <div class="news-card__media"><a href="{{ route('news.show', $item->slug) }}"><img src="{!! \Storage::disk('public')->url($item->image_small) !!}" alt="" /></a></div>
                                    <div class="news-card__info">
                                        <div class="news-card__title"><a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a></div>
                                        <div class="news-card__text">
                                            <p>{!! Str::limit($item->body, 187) !!}</p>
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
                <div class="page-pagination mb-0">
                    @if($data->hasPages())
                        {{ $data->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
