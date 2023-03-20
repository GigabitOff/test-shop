<div class="lk-page__content">
    <h1 class="lk-page__title">{{__('custom::site.comparisons')}}</h1>
    <div class="compare-content">
        <div class="row g-0">
            <div class="col-md-3">
                <div class="section-compare-sidebar">
                    <div class="compare-sidebar">
                        <div class="compare-sidebar__head">
                            <h3>@lang('custom::site.technical_characteristics')</h3>
                            <label class="check"><input class="check__input" type="checkbox" onchange="document.comparisons.toggleAttrs()"/><span class="check__box"></span><span class="check__txt">Тільки відмінності</span></label>
                        </div>
                        <div class="compare-sidebar__body">
                            <ul class="compare-sidebar__list">
                                @foreach($attributes as $id => $name)
                                    <li class="filtered attribute-{{$id}}" data-attribute="{{$id}}">{{$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="section-compare-content">
                    <div class="js-compare-slider-2 compare-items">
                        <div class="swiper" wire:ignore>
                            <div class="swiper-wrapper">
                                @foreach($products as $product)
                                    <div class="swiper-slide">
                                        <x-comparable-product-card :product="$product" :attrs="$attributes" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        const compareSlider2 = new Swiper('.js-compare-slider-2 .swiper', {
            loop: false,
            slidesPerView: 1,
            observeParents: true,
            observeSlideChildren: true,
            observer: true,
            speed: 500,
            scrollbar: {
                el: '.js-compare-slider-2 .swiper-scrollbar',
                draggable: true,
            },
            breakpoints: {
                767: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
                1599: {
                    slidesPerView: 4,
                },
            },
        });
        document.comparisons = {
            viewAll: function(){
                // $('.compare-sidebar .filter-all').addClass('active');
                // $('.compare-sidebar .filter-difference').removeClass('active');
                //
                // $('.compare-sidebar__list .filtered').show();
                // $('.compare-item__list .filtered').show();
            },
            viewDifference: function (){
                // $('.compare-sidebar .filter-all').removeClass('active');
                // $('.compare-sidebar .filter-difference').addClass('active');

                const attributes = $('.compare-sidebar__list .filtered')
                    .map((i,el)=>$(el).data('attribute')).toArray();

                attributes.forEach(attribute=>{
                    const ids = $('.compare-item__list .filtered.attribute-' + attribute)
                        .map((i, el)=>$(el).data('terms'))
                        .toArray();

                    const unique = [...new Set(ids)];

                    // Удаление аттрибутов с пустыми значениями.
                    if(unique.filter(Boolean).length === 0){
                        $('.compare-sidebar__list .filtered.attribute-' + attribute).remove();
                        $('.compare-item__list .filtered.attribute-' + attribute).remove()
                    }

                    if(unique.length === 1){
                        $('.compare-sidebar__list .filtered.attribute-' + attribute).hide();
                        $('.compare-item__list .filtered.attribute-' + attribute).hide()
                    }
                })
            },
            toggleAttrs: function() {
                if ($('input.check__input').is(':checked')) {
                    this.viewDifference();
                } else {
                    this.viewAll();
                }
            }
        }
        //# sourceURL=comparisons.page-main-livewire.js
    </script>
@endpush
