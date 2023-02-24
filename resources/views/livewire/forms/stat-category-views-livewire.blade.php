<div class="modal-content">
    @if($isUploadLazyContent)
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
        <h3>@lang('custom::site.views_quantity')</h3>
        <div class="lk-widjet-cards--views">
            <ul class="widjet-cards-list">
                @foreach($views as $view)
                <li class="widjet-cards-list__item">
                    <div class="widjet-cards-list__item-box">
                        <div class="widjet-cards-list__item-title">{{$view['categoryName']}}</div>
                        <div class="widjet-cards-list__item-numb">№ {{$view['id']}}</div>
                        <div class="widjet-cards-list__item-value">
                            <div class="widjet-cards-list__item-icon" style="color: #FF7549"></div>
                            {{$view['quantity']}}
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
