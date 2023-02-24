<div class="lk-widjet lk-widjet-cards lk-widjet-cards--views" id="stat-category-views-widget">
    <div class="lk-widjet__parallax">
        <div class="lk-widjet__decor" data-depth="0.4"><img
                src="/assets/img/widjet-receivables.svg" alt=""></div>
    </div>
    <div class="lk-widjet__header">
        @php($forwardsQty = count($forwards) ? '+' . count($forwards) : '')
        <div class="lk-widjet__title @if($forwardsQty) forwards @endif">
            @lang('custom::site.views_quantity') <span>{{$forwardsQty}}</span>
        </div>
        <a class="lk-widjet__more-btn"
           onclick="document.lazyWireModal.uploadAndShow('modal-view-visits')"
           href="javascript:void(0);"><span class="ico_angel-r"></span></a>
    </div>
    <div class="lk-widjet__body">
        <ul class="widjet-cards-list">
            @foreach($views as $view)
                @if($loop->iteration > 6) @break @endif
                <li class="widjet-cards-list__item">
                    <a class="widjet-cards-list__item-box"
                       href="{{route('catalog.show_single', ['slug' => $view['categorySlug']])}}">
                        <div class="widjet-cards-list__item-title">{{$view['categoryName']}}</div>
                        <div class="widjet-cards-list__item-numb">№ {{$view['categoryId']}}</div>
                        <div class="widjet-cards-list__item-value">
                            <div class="widjet-cards-list__item-icon"
                                 style="color: #FF7549"></div>
                            {{$view['quantity']}}
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
            $(document).on('lazyModalUploaded', function (e, options) {
                if ('modal-view-visits' === options.componentId) {
                    const hasForwards = $('#stat-category-views-widget .forwards').length;
                    if (hasForwards) {
                    @this.clearForwards();
                    }
                }
            })
        });

    </script>
@endpush
