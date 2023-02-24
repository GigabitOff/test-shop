<x-app-layout body-classes="page-main">
    <main class="page-main page-about">
        <section class="section-banner --mobile">
            <div class="container-xl">
                <div class="banner" data-aos="zoom-in" data-aos-duration="300">
                    <div class="banner__box">
                        <div class="banner__desc" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                            <div class="banner__top"><a class="button-back" href="/">@lang('custom::site.Come back')<i class="ico_angle-left"></i></a><span>{!! isset($page->title) ? $page->title : '' !!}</span></div>
                            <h3 class="banner__title">{!! strip_tags($page->subtitle) !!}</h3>
                            <p class="banner__text">{!! strip_tags($page->description) !!}</p>
                        </div>
                        <div class="banner__media" style="background-image: url({{ \Storage::disk('public')->url($page->image) }})"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-desc">
            <div class="container-lg">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-5" data-aos="fade-right" data-aos-delay="400" data-aos-duration="500">
                        <h3 class="title">{!! $page->title_description !!}</h3>
                        {!! $page->body !!}
                    </div>
                    <div class="col-xl-7">
                        <div class="row g-5">
                            @if(!empty($settings['about_benefits1_count']))
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400" data-aos-duration="500">
                                    <div class="jobs-info --small">
                                        <div class="jobs-info__box">
                                            <div class="jobs-info__media"><img src="{{ isset($settings['about_benefits1_image_1'])?\Storage::disk('public')->url(setSettings($settings['about_benefits1_image_1'])):'' }}" alt=""></div>
                                            <div class="jobs-info__desc">
                                                <h6 class="jobs-info__title">{!! isset($settings['about_benefits1_count'])?setSettings($settings['about_benefits1_count']):'' !!}</h6>
                                                <div class="jobs-info__text">
                                                    <p>{!! isset($settings['about_benefits1_title'])?setSettings($settings['about_benefits1_title']):'' !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($settings['about_benefits1_count2']))
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="500" data-aos-duration="500">
                                    <div class="jobs-info --small">
                                        <div class="jobs-info__box">
                                            <div class="jobs-info__media"><img src="{{ isset($settings['about_benefits1_image_2'])?\Storage::disk('public')->url(setSettings($settings['about_benefits1_image_2'])):'' }}" alt=""></div>
                                            <div class="jobs-info__desc">
                                                <h6 class="jobs-info__title">{!! isset($settings['about_benefits1_count2'])?setSettings($settings['about_benefits1_count2']):'' !!}</h6>
                                                <div class="jobs-info__text">
                                                    <p>{!! isset($settings['about_benefits1_title_2'])?setSettings($settings['about_benefits1_title_2']):'' !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($settings['about_benefits1_count3']))
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="600" data-aos-duration="500">
                                    <div class="jobs-info --small">
                                        <div class="jobs-info__box">
                                            <div class="jobs-info__media"><img src="{{ isset($settings['about_benefits1_image_3'])?\Storage::disk('public')->url(setSettings($settings['about_benefits1_image_3'])):'' }}" alt=""></div>
                                            <div class="jobs-info__desc">
                                                <h6 class="jobs-info__title">{!! isset($settings['about_benefits1_count3'])?setSettings($settings['about_benefits1_count3']):'' !!}</h6>
                                                <div class="jobs-info__text">
                                                    <p>{!! isset($settings['about_benefits1_title_3'])?setSettings($settings['about_benefits1_title_3']):'' !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($settings['about_benefits1_count4']))
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="700" data-aos-duration="500">
                                    <div class="jobs-info --small">
                                        <div class="jobs-info__box">
                                            <div class="jobs-info__media"><img src="{{ isset($settings['about_benefits1_image_4'])?\Storage::disk('public')->url(setSettings($settings['about_benefits1_image_4'])):'' }}" alt=""></div>
                                            <div class="jobs-info__desc">
                                                <h6 class="jobs-info__title">{!! isset($settings['about_benefits1_count4'])?setSettings($settings['about_benefits1_count4']):'' !!}</h6>
                                                <div class="jobs-info__text">
                                                    <p>{!! isset($settings['about_benefits1_title_4'])?setSettings($settings['about_benefits1_title_4']):'' !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-video">
            <div class="container-lg">
                <div class="row g-5 align-items-center">
                    @if(!empty($settings['about_working_url']))
                        <div class="col-md-6" data-aos="fade-up" data-aos-duration="500">
                            <div class="video-box"><a class="video-box__link" href="{{ setSettings($settings['about_working_url']) }}" data-fancybox><img class="video-box__img" src="{{ isset($settings['about_working_image'])?\Storage::disk('public')->url(setSettings($settings['about_working_image'])):'' }}" alt="video"><span class="video-box__btn"></span></a></div>
                        </div>
                    @endif
                    @if(!empty($settings['about_working_title']))
                        <div class="col-md-6" data-aos="fade-down" data-aos-delay="300" data-aos-duration="500">
                            <h3 class="title">{{ setSettings($settings['about_working_title']) }}</h3>
                            {!! isset($settings['about_working_description'])?setSettings($settings['about_working_description']):'' !!}
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="about-statistics">
            <div class="container-lg">
                <h3 class="title text-center" data-aos="zoom-in" data-aos-duration="500">@lang('custom::site.about_advatages_main_title')</h3>
                <ul class="statistics">
                    @if(!empty($settings['about_benefits2_title_1']))
                        <li class="statistics__item" data-aos="fade-right" data-aos-delay="100" data-aos-duration="500">
                            <img class="statistics__ico" src="{{ isset($settings['about_benefits2_image_1'])?\Storage::disk('public')->url(setSettings($settings['about_benefits2_image_1'])):'' }}" alt="statistic">
                            <span class="statistics__value">{!! setSettings($settings['about_benefits2_count1']) !!}</span>
                            <span class="statistics__text">{!! isset($settings['about_benefits2_title_1'])?setSettings($settings['about_benefits2_title_1']):'' !!}</span>
                        </li>
                    @endif
                    @if(!empty($settings['about_benefits2_count2']))
                        <li class="statistics__item" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500">
                            <img class="statistics__ico" src="{{ isset($settings['about_benefits2_image_2'])?\Storage::disk('public')->url(setSettings($settings['about_benefits2_image_2'])):'' }}" alt="statistic">
                            <span class="statistics__value">{!! setSettings($settings['about_benefits2_count2']) !!}</span>
                            <span class="statistics__text">{!! isset($settings['about_benefits2_title_2'])?setSettings($settings['about_benefits2_title_2']):'' !!}</span>
                        </li>
                    @endif
                    @if(!empty($settings['about_benefits2_count3']))
                        <li class="statistics__item" data-aos="fade-right" data-aos-delay="300" data-aos-duration="500">
                            <img class="statistics__ico" src="{{ isset($settings['about_benefits2_image_3'])?\Storage::disk('public')->url(setSettings($settings['about_benefits2_image_3'])):'' }}" alt="statistic">
                            <span class="statistics__value">{!! setSettings($settings['about_benefits2_count3']) !!}</span>
                            <span class="statistics__text">{!! isset($settings['about_benefits2_title_3'])?setSettings($settings['about_benefits2_title_3']):'' !!}</span>
                        </li>
                    @endif
                    @if(!empty($settings['about_benefits2_count4']))
                        <li class="statistics__item" data-aos="fade-right" data-aos-delay="400" data-aos-duration="500">
                            <img class="statistics__ico" src="{{ isset($settings['about_benefits2_image_4'])?\Storage::disk('public')->url(setSettings($settings['about_benefits2_image_4'])):'' }}" alt="statistic">
                            <span class="statistics__value">{!! setSettings($settings['about_benefits2_count4']) !!}</span>
                            <span class="statistics__text">{!! isset($settings['about_benefits2_title_4'])?setSettings($settings['about_benefits2_title_4']):'' !!}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </section>
        <section class="about-partners">
            <div class="container-lg">
                <h3 class="title" data-aos="zoom-in" data-aos-duration="500">@lang('custom::site.our_partners')</h3>
                <div class="partners-slider js-partners-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach($brands as $brand)
                                <div class="swiper-slide" data-aos="fade-right" data-aos-delay="100" data-aos-duration="500">
                                    <div class="brand-card">
                                        <a class="brand-card__link" href="{{ route('brands.show', [$brand->slug])}}">
                                            <div class="brand-card__media">
                                                <img src="{{ $brand->imageSrc }}" alt="{{ $brand->title }}">
                                            </div>
                                            <div class="brand-card__desc">
                                                <span>{{$brand->title}}</span>
                                                <button class="button-more-brands"
                                                        type="button">@lang('custom::site.more')</button>
                                            </div>
                                        </a></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-nav --section-slider-nav --mobile" data-aos="fade-left" data-aos-delay="1000" data-aos-duration="500">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-plus">
            <div class="container-lg">
                <div class="about-plus-item">
                    <div class="row g-5 align-items-center">
                        @if(!empty($settings['about_5_block_subtitle']))
                            <div class="col-md-6" data-aos="fade-down" data-aos-delay="100" data-aos-duration="500">
                                <div class="about-plus-item__img"><img src="{{ isset($settings['about_5_block_image'])?\Storage::disk('public')->url(setSettings($settings['about_5_block_image'])):'' }}" alt="image">
                                    <div class="jobs-info --small">
                                        <div class="jobs-info__box">
                                            <div class="jobs-info__media"><img src="{{ isset($settings['about_5_block_icon'])?\Storage::disk('public')->url(setSettings($settings['about_5_block_icon'])):'' }}" alt="jobs"></div>
                                            <div class="jobs-info__desc">
                                                <h6 class="jobs-info__title">{!! setSettings($settings['about_5_block_subtitle']) !!}</h6>
                                                @if(!empty($settings['about_6_block_short_description']))
                                                    <div class="jobs-info__text">
                                                        <p>{!! setSettings($settings['about_5_block_short_description']) !!}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($settings['about_5_block_title']))
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300" data-aos-duration="500">
                                <div class="about-plus-item__desc">
                                    <h3 class="title">{!! setSettings($settings['about_5_block_title']) !!}</h3>
                                    {!! isset($settings['about_5_block_description'])?setSettings($settings['about_5_block_description']):'' !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="about-plus-item">
                    <div class="row g-5 align-items-center">
                        @if(!empty($settings['about_6_block_subtitle']))
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300" data-aos-duration="500">
                                <div class="about-plus-item__img"><img src="{{ isset($settings['about_6_block_image'])?\Storage::disk('public')->url(setSettings($settings['about_6_block_image'])):'' }}" alt="image">
                                    <div class="jobs-info --small">
                                        <div class="jobs-info__box">
                                            <div class="jobs-info__media"><img src="{{ isset($settings['about_6_block_icon'])?\Storage::disk('public')->url(setSettings($settings['about_6_block_icon'])):'' }}" alt="jobs"></div>
                                            <div class="jobs-info__desc">
                                                <h6 class="jobs-info__title">{!! setSettings($settings['about_6_block_subtitle']) !!}</h6>
                                                @if(!empty($settings['about_6_block_short_description']))
                                                    <div class="jobs-info__text">
                                                        <p>{!! setSettings($settings['about_6_block_short_description']) !!}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($settings['about_6_block_title']))
                            <div class="col-md-6" data-aos="fade-down" data-aos-delay="100" data-aos-duration="500">
                                <div class="about-plus-item__desc">
                                    <h3 class="title">{!! setSettings($settings['about_6_block_title']) !!}</h3>
                                    {!! isset($settings['about_6_block_description'])?setSettings($settings['about_6_block_description']):'' !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
