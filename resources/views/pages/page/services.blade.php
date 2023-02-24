<x-app-layout body-classes="page-delivery">
    <main class="page-main page-services">
        <section class="section-banner --mobile">
            <div class="container-xl">
                <div class="banner" data-aos="zoom-in" data-aos-duration="300">
                    <div class="banner__box">
                        <div class="banner__desc" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                            <div class="banner__top"><a class="button-back"
                                                        href="{{route('main')}}">@lang('custom::site.Come back')<i
                                            class="ico_angle-left"></i></a><span>{{$services->title ?? ''}}</span></div>
                            <h3 class="banner__title">{{$banner->title ?? ''}}</h3>

                            <p class="banner__text">{{$banner->description ?? ''}}</p>
                        </div>
                        <div class="banner__media"
                             style="background-image: url({{\Storage::disk('public')->url($banner->image ?? '')}})"></div>
                    </div>
                </div>
            </div>
        </section>
        <div class="page-content">
            <div class="container-lg">
                <div class="service-items">
                    @foreach($services->PageItems->sortBy('order') as $service)
                        <div class="service-item">
                            <div class="service-item__box">
                                <div class="service-item__media"><img
                                            src="{{\Storage::disk('public')->url($service->image)}}" alt="img-service">

                                    <div class="service-item__intro">
                                        <div><img src="{{\Storage::disk('public')->url($service->icon)}}"
                                                  alt="ico-service"></div>
                                        <div><span>{!! $service->description !!}</span></div>
                                    </div>
                                </div>
                                <div class="service-item__desc">
                                    <div class="service-item__title">{!! $service->title !!}</div>
                                    <div class="service-item__text">
                                        {!!$service->body !!}
                                    </div>
                                    <div class="service-item__btn"><a class="button button-accent"
                                                                      href="{{$service->url}}">@lang('custom::site.to_order')</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-app-layout>