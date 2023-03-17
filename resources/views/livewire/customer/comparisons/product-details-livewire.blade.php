<div class="product-full-box --compare">
    <div class="product-full-box__head">
        <div class="product-full-box__title">{{__('custom::site.comparisons')}}</div>
    </div>
    <div class="product-full-box__body">
        <div class="compare-content">
            <div class="row g-0">
                <div class="col-xl-2 --compare-hidden-md">
                    <div class="section-compare-sidebar">
                        <div class="compare-sidebar">
                            <div class="compare-sidebar__head"></div>
                            <div class="compare-sidebar__body">
                                <ul class="compare-sidebar__list">
                                    @foreach($attributes as $id => $name)
                                        <li data-attribute="{{$id}}">{{$name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10">
                    <div class="section-compare-content">
                        <div class="js-compare-slider compare-items">
                            <div class="swiper" wire:ignore>
                                <div class="swiper-wrapper">
                                    @foreach($products as $product)
                                        <div class="swiper-slide">
                                            <x-compare-to-product-card :product="$product" :attrs="$attributes" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="swiper-nav --section-slider-nav">
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
