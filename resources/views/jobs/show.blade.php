<x-app-layout body-classes="page-jobs">
    <main class="page-main page-jobs">
        <section class="section-banner --mobile">
            <div class="container-xl">
                <div class="banner" data-aos="zoom-in" data-aos-duration="300">
                    <div class="banner__box">
                        <div class="banner__desc" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                            <div class="banner__top"><a class="button-back" href="/jobs">@lang('custom::site.Come back')<i class="ico_angle-left"></i></a><span>{{(isset($page->seo_h1) AND $page->seo_h1) != '' ? $page->seo_h1 : $page->title}}</span></div>
                            <h3 class="banner__title">{!! $vacancy->title !!}</h3>
                            <p class="banner__text">{!! $vacancy->description !!}</p>
                            <div class="banner__bottom">
                                <div class="banner__btn"><a class="button-outline" href="#m-jobs" data-bs-toggle="modal">@lang('custom::site.Send an application')</a></div>
                            </div>
                        </div>
                        <div class="banner__media" style="background-image: url({{ \Storage::disk('public')->url($page->image_small) }})"></div>
                    </div>
                </div>
            </div>
        </section>
        <div class="page-content --jobs">
            <div class="container-xl">
                <div class="row g-5">
                    <div class="col-xl-6" data-aos="fade-right" data-aos-delay="400" data-aos-duration="500">
                        <div class="jobs-info">
                            <div class="jobs-info__box">
                                <div class="jobs-info__media"><img src="{{ \Storage::disk('public')->url($vacancy->image_1) }}" alt="jobs"></div>
                                <div class="jobs-info__desc">
                                    <h6 class="jobs-info__title">{!! $vacancy->title_image_1 !!}</h6>
                                    <div class="jobs-info__text">
                                        {!! $vacancy->text_image_1 !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6" data-aos="fade-right" data-aos-delay="600" data-aos-duration="500">
                        <div class="jobs-info">
                            <div class="jobs-info__box">
                                <div class="jobs-info__media"><img src="{{ \Storage::disk('public')->url($vacancy->image_2) }}" alt="jobs"></div>
                                <div class="jobs-info__desc">
                                    <h6 class="jobs-info__title">{!! $vacancy->title_image_2 !!}</h6>
                                    <div class="jobs-info__text">
                                        {!! $vacancy->text_image_2 !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6" data-aos="fade-right" data-aos-delay="800" data-aos-duration="500">
                        <div class="jobs-info">
                            <div class="jobs-info__box">
                                <div class="jobs-info__media"><img src="{{ \Storage::disk('public')->url($vacancy->image_3) }}" alt="jobs"></div>
                                <div class="jobs-info__desc">
                                    <h6 class="jobs-info__title">{!! $vacancy->title_image_3 !!}</h6>
                                    <div class="jobs-info__text">
                                        {!! $vacancy->text_image_3 !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6" data-aos="fade-right" data-aos-delay="1000" data-aos-duration="500">
                        <div class="jobs-info">
                            <div class="jobs-info__box">
                                <div class="jobs-info__media"><img src="{{ \Storage::disk('public')->url($vacancy->image_4) }}" alt="jobs"></div>
                                <div class="jobs-info__desc">
                                    <h6 class="jobs-info__title">{!! $vacancy->title_image_4 !!}</h6>
                                    <div class="jobs-info__text">
                                        {!! $vacancy->text_image_4 !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5"><a class="button-outline" href="#m-jobs" data-bs-toggle="modal">@lang('custom::site.Send an application')</a></div>
            </div>
        </div>
    </main>
</x-app-layout>
