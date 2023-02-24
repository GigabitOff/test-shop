<div class="lk-widjet lk-widjet-cards lk-widjet-cards--search" id="stat-product-sales-widget">
    <div class="lk-widjet__parallax">
        <div class="lk-widjet__decor" data-depth="-0.2"><img
                src="/assets/img/widjet-receivables.svg" alt=""></div>
    </div>
    <div class="lk-widjet__header">
        @php($forwardsQty = count($forwards) ? '+' . count($forwards) : '')
        <div class="lk-widjet__title @if($forwardsQty) forwards @endif">
            @lang('custom::site.product_sales') <span>{{$forwardsQty}}</span>
        </div>
        <a class="lk-widjet__more-btn"
           onclick="document.lazyWireModal.uploadAndShow('modal-search-products')"
           href="javascript:void(0);"><span class="ico_angel-r"></span></a>
    </div>
    <div class="lk-widjet__body ">
        <ul class="widjet-cards-list">
            @foreach($products as $product)
                @if($loop->iteration > 6) @break @endif
                <li class="widjet-cards-list__item">
                    <a class="widjet-cards-list__item-box"
                       href="javascript:void(0);">
                        <div class="widjet-cards-list__item-title">{{$product['translatedName']}}</div>
                        <div class="widjet-cards-list__item-numb">№ {{$product['articul']}}</div>
                        <div class="widjet-cards-list__item-value">
                            <div class="widjet-cards-list__item-icon"
                                 style="color: #FF7549"></div>
                            {{$product['sales']}}
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            $(document).on('lazyModalUploaded', function (e, options){
                if('modal-search-products' === options.componentId){
                    const hasForwards = $('#stat-product-sales-widget .forwards').length;
                    if(hasForwards){
                        @this.clearForwards();
                    }
                }
            })
        });

    </script>
@endpush
