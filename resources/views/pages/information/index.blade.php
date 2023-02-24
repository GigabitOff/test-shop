<x-app-layout>
  <main class="page-main page-privacy-policy">
    <section class="section-banner --mobile">
      <div class="container-xl">
        <div class="banner" data-aos="zoom-in" data-aos-duration="300">
          <div class="banner__box">
            <div class="banner__desc" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
              <div class="banner__top"><a class="button-back" href="{{route('main')}}">@lang('custom::site.Come back')<i class="ico_angle-left"></i></a><span>
              {{$informationProcessing->title ?? ''}}</span></div>
              <h3 class="banner__title">{{$banner->title ?? ''}}</h3>
              <p class="banner__text">{{$banner->description ?? ''}}</p>
            </div>
            <div class="banner__media" style="background-image: url({{\Storage::disk('public')->url($banner->image ?? '')}})"></div>
          </div>
        </div>
      </div>
    </section>
    <div class="page-content">
      <div class="container-xl container-text">
        <div class="row g-5" data-aos="fade-up" data-aos-delay="400" data-aos-duration="500">
          <div class="col-12">
            {!! $informationProcessing->description ?? '' !!}
          </div>
          <div class="col-12">
            {!! $informationProcessing->body ?? '' !!}
          </div>
        </div>
      </div>
    </div>
  </main>
</x-app-layout>
