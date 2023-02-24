<div class="modal-content">
    @if($isUploadLazyContent)
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
        <h3>@lang('custom::site.product_sales')</h3>
        <div class="lk-widjet-cards--search">
            <ul class="widjet-cards-list">
                @foreach($products as $product)
                <li class="widjet-cards-list__item">
                    <div class="widjet-cards-list__item-box">
                        <div class="widjet-cards-list__item-title">{{$product->name}}</div>
                        <div class="widjet-cards-list__item-numb">№ {{$product->articul}}</div>
                        <div class="widjet-cards-list__item-value">
                            <div class="widjet-cards-list__item-icon" style="color: #FF7549"></div>
                            {{$product->sales}}
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
