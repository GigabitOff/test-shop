<div class="lk-widjet lk-widjet-links">
    <div class="lk-widjet__header">
        <div class="lk-widjet__title">@lang('custom::site.referrer_source')</div>
        <a class="lk-widjet__more-btn"
           onclick="document.lazyWireModal.uploadAndShow('modal-search-links')"
           href="javascript:void(0);"><span class="ico_angel-r"></span></a>
    </div>
    <div class="lk-widjet__body">
        <ul class="widjet-links-list">
            @foreach($referrers as $referrer)
                @php($text = $referrer->referrer_title ?: $referrer->referrer_url)
                <li class="widjet-links-list__item">
                    <a class="widjet-links-list__item-link"
                       href="https://www.facebook.com"
                       target="_blank">
                        <span class="ico_link"></span>
                        <span class="widjet-links-list__item-text">{{$text}}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
