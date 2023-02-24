<div class="lk-page__main">
    <div class="lk-page-header">
        <div class="lk-page-title">@lang('custom::site.comparisons')</div>
    </div>
    <div class="lk-compare-content">
        <div class="row">
            <div class="col-xl-3">
                <div class="section-compare-sidebar">
                    <div class="compare-sidebar">
                        <div class="compare-sidebar__head">
                            <h3>@lang('custom::site.technical_characteristics')</h3>
                            <ul>
                                <li class="filter-all active">
                                    <a href="javascript:void(0);"
                                        onclick="document.comparisons.viewAll()">@lang('custom::site.all')</a>
                                </li>
                                <li class="filter-difference">
                                    <a href="javascript:void(0);"
                                       onclick="document.comparisons.viewDifference()">@lang('custom::site.only_differences')</a>
                                </li>
                            </ul>
                        </div>
                        <div class="compare-sidebar__body">
                            <ul class="compare-sidebar__list">
                                <li>@lang('custom::site.price')</li>
                                @foreach($attributes as $id => $name)
                                    <li class="filtered attribute-{{$id}}" data-attribute="{{$id}}">{{$name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-md-8">
                <div class="section-compare-content">
                    <div class="js-compare-slider compare-items">
                        <div class="swiper-container" wire:ignore>
                            <div class="swiper-wrapper">
                                @foreach($products as $product)
                                    @php([$url, $image] = $product->compactUrlImage())
                                    <div class="swiper-slide">
                                        <div class="compare-item product-item product-{{$product->id}}">
                                            <div class="compare-item__head">
                                                <div class="compare-item__box">
                                                    <div class="compare-item__media">
                                                        <div class="compare-item__action">
                                                            @php($hasFavorites = favourites()->isExistProduct($product->id))
                                                            <div
                                                                class="js-add-favorites compare-item__favorites  @if($hasFavorites) is-active @endif"
                                                                onclick="Livewire.emit('eventToggleFavourite', {'product_id':{{$product->id}}})">
                                                                <span class="ico_favorites"></span>
                                                            </div>
                                                            <div class="js-remove-compare-item compare-item__remove"
                                                                 onclick="Livewire.emit('eventRemoveComparisonsItem', {'product_id':{{$product->id}}})"
                                                            ><span class="ico_close"></span></div>
                                                        </div>
                                                        <img src="{{$image}}" alt="compare"/>
                                                    </div>
                                                    <div class="compare-item__title">
                                                        <a href="{{$url}}">{{$product->name}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="compare-item__body">
                                                <ul class="compare-item__list">
                                                    <li>
                                                        <div class="compare-item__item">
                                                            <span class="label">@lang('custom::site.price')</span>
                                                            <span
                                                                class="value">{{formatMoney($product->price)}} @lang('custom::site.uah')</span>
                                                        </div>
                                                    </li>
                                                    @foreach($attributes as $id => $name)
                                                        <li class="filtered attribute-{{$id}}"
                                                            data-attribute="{{$id}}"
                                                            data-terms="{{$this->productAttributeTermIds($product, $id)}}">
                                                            <div class="compare-item__item"><span
                                                                    class="label">{{$name}}</span><span
                                                                    class="value">{{$this->productTermsLine($product, $id)}}</span></div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
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
        document.comparisons = {
            viewAll: function(){
                $('.compare-sidebar .filter-all').addClass('active');
                $('.compare-sidebar .filter-difference').removeClass('active');

                $('.compare-sidebar__list .filtered').show();
                $('.compare-item__list .filtered').show();
            },
            viewDifference: function (){
                $('.compare-sidebar .filter-all').removeClass('active');
                $('.compare-sidebar .filter-difference').addClass('active');

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
            }
        }
        //# sourceURL=comparisons.page-main-livewire.js
    </script>
@endpush
