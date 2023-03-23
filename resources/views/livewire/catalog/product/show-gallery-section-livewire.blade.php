@php
if ($images->isEmpty() || count($images) == 1) {
    $galleryCls = '--preview-none';
    $imgCls = 'js-product-full-single';
} else {
    $imgCls = 'js-product-full';
    $galleryCls = '';
}
@endphp
<div class="product-gallery {{$galleryCls}}">
    <div class="product-gallery-box">
        <div class="product-gallery__compare">
            <button class="js-add-compare ico_compare @if(comparisons()->isExistProduct($product->id)) is-active @endif"
                    onclick="Livewire.emit('eventToggleComparisons', {'product_id' : {{$product->id}} })"></button>
        </div>
        <div class="product-gallery__brand">
            @if($product->brandImageUrl)
                <img src="{{$product->brandImageUrl}}" alt="logo-brand">
            @endif
        </div>
        <div class="{{$imgCls}} product-full-slider">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @forelse($images as $key=>$image)
                        <div class="swiper-slide">
                            <a href="{{\Storage::disk('public')->url($image->url)}}"
                               data-fancybox="product-fancybox">
                                <img src="{{\Storage::disk('public')->url($image->url)}}" alt="product-full">
                            </a>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <img class="slide-empty" src="{{fallbackBaseImageUrl('')}}" alt="product-full"/>
                        </div>
                    @endforelse
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
    @if($images->isNotEmpty())
    <div class="product-gallery-thumb">
        <div class="js-product-thumb product-thumb-slider">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach($images as $imgs)
                        <div class="swiper-slide">
                            <img src="{{\Storage::disk('public')->url($imgs->url)}}"
                                 alt="product-thumb"></div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
    @endif
</div>
