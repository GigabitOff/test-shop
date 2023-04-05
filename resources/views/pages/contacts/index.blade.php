<x-app-layout body-classes="page-contacts">
    <main class="page-main page-contacts">
        @if($banners->first())
        <section class="section-banner --mobile">
            <div class="container-xl">
                <div class="banner" data-aos="zoom-in" data-aos-duration="300">
                    <div class="banner__box">
                        <div class="banner__desc" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                            <div class="banner__top"><a class="button-back" href="/">@lang('custom::site.Come back')<i class="ico_angle-left"></i></a><span>{{(isset($page->seo_h1) AND $page->seo_h1) != '' ? $page->seo_h1 : $page->title}}</span></div>
                            <h3 class="banner__title">{!! $banners->first()->title !!}</h3>
                            <p class="banner__text">{!! $banners->first()->description?$banners->first()->description : '' !!}</p>
                        </div>
                        <div class="banner__media" style="background-image: url({!! $banners->first()->image ?  \Storage::disk('public')->url($banners->first()->image) : '' !!})"></div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @if($shops && count($shops))
            <section class="contacts-items">
                <div class="container-xl">
                    <div class="row g-5">
                        @foreach ($shops as $item_sh)
                        <div class="col-12">
                        <h3 class="section-title mb-0">{{ $item_sh->title }}</h3>
                        </div>
                            @if(count($item_sh->getContucts)>0)
                            @foreach ($item_sh->getContucts as $item)

                            <div class="col-xl-4" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500">
                                <div class="contacts-item">
                                    <a class="contacts-item__link" href="#m-contacts{{ $item->id }}" data-bs-toggle="modal">
                                        <div class="contacts-item__info">
                                            <div class="contacts-item__title">{{ $item->title }}</div>
                                            <div class="contacts-item__location"><i class="ico_location"></i>{{ $item->address_lang }}</div>
                                        </div>
                                        <div class="contacts-item__btn"><button class="button-more" type="button"></button></div>
                                    </a>
                                </div>
                            </div>

                            <div class="modal fade m-contacts" id="m-contacts{{ $item->id }}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $item->title }}</h5>
                                            <div class="m-contacts__location"><i class="ico_location"></i>
                                                <span>{{ $item->address_lang }}</span>
                                            </div><button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="js-contacts-slider">
                                                <div class="swiper">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="contacts-user-card">
                                                                    <div class="contacts-user-card__box">
                                                                        @if($item->shop)
                                                                            <div class="contacts-user-card__avatar"><img src="{{ \Storage::disk('public')->url($item->shop->image) }}" alt="avatar"></div>
                                                                            <div class="contacts-user-card__name">{{ $item->shop->title }}</div>
                                                                            <div class="contacts-user-card__position">{{ $item->shop->posada }}</div>
                                                                            <div class="contacts-user-card__line"></div>
                                                                            <div class="contacts-user-card__links">
                                                                                @foreach (json_decode($item->phones,1) as $phone)
                                                                                    <a href="tel:{{ preg_replace('![^0-9]+!', '', $phone) }}">{{ $phone }}</a>
                                                                                @endforeach
                                                                                @foreach (json_decode($item->emails,1) as $email)
                                                                                    <a href="mailto:{{ $email }}">{{ $email }}</a>
                                                                                @endforeach
                                                                            </div>
                                                                            <div class="contacts-user-card__btn">
                                                                                <button type="button" class="open_callback" data-department-id="{{$item->shop->parent_id}}">
                                                                                    @lang('custom::site.write_to')
                                                                                </button>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--<div class="mt-3 d-flex justify-content-center">
                                                        <div class="swiper-nav">
                                                            <div class="swiper-button-prev"></div>
                                                            <div class="swiper-pagination"></div>
                                                            <div class="swiper-button-next"></div>
                                                        </div>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <script>

            //document.shopLocations = @js($locations);

            const markersData = @js($locations);
            @if(isset($locations[1]))
            const lat = @js($locations[1]['lat']);
            const lng = @js($locations[1]['lng']);
            @else
                const lat = @js($locations[0]['lat']);
                const lng = @js($locations[0]['lng']);
            @endif

        </script>
        <section class="contacts-map" data-aos="fade-up" data-aos-delay="800" data-aos-duration="500">
            <div class="container-xl">
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB92cIFqw6xYpuZ7cfizeIwvgDZux3lqTA"></script>
                <div class="contacts-map-box" id="map"></div>
            </div>
        </section>
    </main>
    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('.open_callback').on("click", function() {
                    $('#m-callback-contuct').modal('show');
                    $('#niceSelect_departmentId').val($(this).attr('data-department-id'));
                    Livewire.emit('updatedDepartmentId', $(this).attr('data-department-id'));
                });
            });
        </script>
    @endpush

    <x-modal-form id="m-callback-contuct">
        <livewire:forms.feedback-contuct-livewire/>
    </x-modal-form>
</x-app-layout>
