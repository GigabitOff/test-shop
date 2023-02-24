<x-app-layout body-classes="page-brand">
    <main class="page-main page-brand">
      <section class="section-banner --mobile">
        <div class="container-xl">
          <div class="banner" data-aos="zoom-in" data-aos-duration="300">
            <div class="banner__box">
              <div class="banner__desc" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                <div class="banner__top">
                    <a class="button-back" href="{{route('main')}}">
                        @lang('custom::site.Come back')
                        <i class="ico_angle-left"></i>
                    </a>
                    <span>{{$brand->title ?? '' }}</span>
                </div>
                <h3 class="banner__title">{{$banner->title ?? ''}}</h3>
                <p class="banner__text">{{$banner->description ?? ''}}</p>
                <div class="banner__bottom">
                  <div class="banner__btn">
                      <a class="button-outline"
                         href="{{$banner->link ?? 'javascript:void(0)'}}">@lang('custom::site.Read more')</a></div>
                </div>
              </div>
              <div class="banner__media" style="background-image: url({{\Storage::disk('public')->url($banner->image ?? '')}})"></div>
            </div>
          </div>
        </div>
      </section>
      <div class="page-content">
        <div class="container-xl">
          <div class="row g-5 py-xl-5 py-md-3" data-aos="fade-up" data-aos-delay="400" data-aos-duration="500">
            <div class="col-xl-2 col-md-4 offset-xl-2 text-center">
                <img class="img-fluid mb-2" src="{{fallbackBrandImageUrl($brand->image_full_url)}}" alt="brand {{$brand->title}}"></div>
            <div class="col-xl-6 col-md-8">
            {!! $brand->description !!}
            </div>
          </div>
            <livewire:pages.brands.categories-section-livewire :brand="$brand" />
        </div>
      </div>
    </main>
</x-app-layout>
