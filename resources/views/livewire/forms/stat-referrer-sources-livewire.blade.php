<div class="modal-content">
    @if($isUploadLazyContent)
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
        <h3>@lang('custom::site.referrer_source')</h3>
        <div class="lk-widjet-cards--links">
            <ul class="widjet-links-list">
                @foreach($referrers as $referrer)
                    @php($text = $referrer->referrer_title ?: $referrer->referrer_url)
                    <li class="widjet-links-list__item">
                        <a class="widjet-links-list__item-link" href="{{$referrer->referrer_url}}"><span
                            class="ico_link"></span><span class="widjet-links-list__item-text">{{$text}}</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
