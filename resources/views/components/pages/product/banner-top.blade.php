<div class="banner">
    @if($banner)

        <div class="banner__box">
            <div class="banner__desc">
                <div class="banner__top">
                    <a class="button-back" href="{{$backUrl}}">
                        @lang('custom::site.return')
                            <i class="ico_angle-left"></i>
                    </a>
                    <span>@lang('custom::site.catalog')</span>
                </div>
                <h3 class="banner__title">{{$banner->title}}</h3>
                <p class="banner__text">{!! $banner->description !!}</p>
                <div class="banner__bottom">
                    @if($banner->link)
                        <div class="banner__btn">
                            <a class="button-outline" href="{{$banner->link}}">@lang('custom::site.more')</a>
                        </div>
                    @endif
                </div>
            </div>
            @if($banner->bgImageUrl)
                <div class="banner__media" style="background-image: url({{$banner->bgImageUrl}})"></div>
            @endif
        </div>
    @endif
</div>
