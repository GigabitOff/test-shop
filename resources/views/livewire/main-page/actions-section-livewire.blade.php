<div class="container-xl">
    @foreach($actions as $action)
        <div class="banner" data-aos="fade-down" data-aos-delay="300" data-aos-duration="300">
            <div class="banner__box">
                <div class="banner__desc">
                    <h3 class="banner__title" data-aos="fade-up" data-aos-delay="500"
                        data-aos-duration="500">{{$action->title}}</h3>
                    <p class="banner__text" data-aos="fade-right" data-aos-delay="600"
                       data-aos-duration="500">{{$action->description}}</p>
                    <div class="banner__bottom" data-aos="fade-left"
                         data-aos-delay="700" data-aos-duration="500">
                        <div class="banner__btn">
                            <a href="{{ route('actions.show', $action->id)}}"
                               class="button-outline"
                               type="button">@lang('custom::site.Read more')</a>
                        </div>
                    </div>
                </div>
                <div class="banner__media"
                     style="background-image: url({{$action->imageUrl}})"></div>
            </div>
        </div>
    @endforeach
</div>

