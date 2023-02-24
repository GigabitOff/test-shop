<section class="section-banner-promo">
    @if($banners->first())
    <div class="container-xl">
      <div class="banner-promo" data-aos="fade-down" data-aos-duration="300">
        <div class="banner-promo__bg" style="background-image: url({!! $banners->first()->image ?  \Storage::disk('public')->url($banners->first()->image) : '' !!})">
          <div class="banner-promo__content" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
            <h3 class="banner-promo__title">{!! $banners->first()->title !!}</h3>
             {!! ($banners->first()->link AND $banners->first()->link !='') ? '<a class="button-outline" href="'.$banners->first()->link.'">'.__('custom::site.Read more').'</a>' : ''!!}
          </div>
        </div>
      </div>
    </div>
    @endif
</section>
