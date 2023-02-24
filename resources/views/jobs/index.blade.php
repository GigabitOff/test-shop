<x-app-layout body-classes="page-jobs">
    <main class="page-main page-jobs">
          <section class="section-banner --mobile">
              <div class="container-xl">
                  <div class="banner" data-aos="zoom-in" data-aos-duration="300">
                      <div class="banner__box">
                          <div class="banner__desc" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                              <div class="banner__top"><a class="button-back" href="/">@lang('custom::site.Come back')<i class="ico_angle-left"></i></a><span>{{(isset($page->seo_h1) AND $page->seo_h1) != '' ? $page->seo_h1 : $page->title}}</span></div>
                              <h3 class="banner__title">{!! $page->slogan !!}</h3>
                              <p class="banner__text">{!! $page->slogan_description !!}</p>
                          </div>
                          <div class="banner__media" style="background-image: url({{ \Storage::disk('public')->url($page->image_small) }})" data-aos="zoom-in" data-aos-duration="300"></div>
                      </div>
                  </div>
              </div>
          </section>
          <div class="page-content --jobs">
              <div class="container-xl">
                  <blockquote class="jobs" data-aos="zoom-in" data-aos-delay="400" data-aos-duration="500">
                      <h3>{!! $page->subtitle !!}</h3><span></span>
                      {!! $page->body !!}
                  </blockquote>
                  <div class="row g-5">
                      @for ($i = 1; $i <= 4; $i++)
                          @php
                              $title = null;
                              $title = settingsData('job_title_'.$i,true);
                              $description = settingsData('job_description_'.$i,true);
                              $img_jobs = settingsData('job_image_'.$i);
                          @endphp
                          @if($description AND $title AND $title != '' AND $description != '')
                              <div class="col-xl-3 col-md-6" data-aos="fade-right" data-aos-delay="600" data-aos-duration="500">
                                  <div class="jobs-info --small">
                                      <div class="jobs-info__box">
                                          <div class="jobs-info__media"><img src="{!! \Storage::disk('public')->url($img_jobs->value) !!}" alt="jobs"></div>
                                          <div class="jobs-info__desc">
                                              <h6 class="jobs-info__title">{!! $title !!}</h6>
                                              <div class="jobs-info__text">
                                                  <p>{{ $description }}</p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          @endif
                      @endfor
                  </div>
              </div>
          </div>
          <section class="section-jobs-slider">
              <div class="container-xl position-relative">
                  <div class="section-header">
                      <h3 class="section-title" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500">@lang('custom::site.open_jobs')</h3>
                  </div>
                  <div class="section-content">
                      <div class="jobs-slider js-jobs-slider">
                          <div class="swiper">
                              <div class="swiper-wrapper">
                                  @foreach ($vacancy as $item)
                                      <div class="swiper-slide" data-aos="fade-right" data-aos-delay="300" data-aos-duration="500">
                                          <div class="jobs-card">
                                              <div class="jobs-card__box">
                                                  <h6 class="jobs-card__title">{{ $item->title }}</h6>
                                                  <ul class="jobs-card__info">
                                                      @if( $item->getCity )<li><i class="ico_location"></i><span>{{ $item->getCity->title }}</span></li>@endif
                                                      @if( $item->schedule_lang || $item->whours_lang)<li><i class="ico_time"></i><span>{{ $item->schedule_lang }} {{ $item->whours_lang }}</span></li>@endif
                                                  </ul>
                                                  <p class="jobs-card__desc">{{ Str::limit($item->description, 187) }}</p>
                                                  <div class="jobs-card__btn"><a class="button-more" href="{{ route('jobs.show', $item->slug) }}"></a></div>
                                              </div>
                                          </div>
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
          <section class="section-banner-promo">
              <div class="container-xl">
                  <div class="banner-promo" data-aos="fade-up" data-aos-duration="500">
                      <div class="banner-promo__bg" style="background-image: url({{ \Storage::disk('public')->url($page->image) }})">
                          <div class="banner-promo__content" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="500">
                              <h3 class="banner-promo__title">{!! settingsData('job_title_image_2',true) !!}</h3>
                              <p class="banner-promo__text">{{ settingsData('job_description_image_2',true) }}</p><a class="button-outline" href="#m-jobs" data-bs-toggle="modal">@lang('custom::site.Send an application')</a>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </main>
</x-app-layout>
