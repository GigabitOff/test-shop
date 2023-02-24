<div class="widjet-banner">
    @if(!empty($content))
        <a class="widjet-banner__bg" href="{{$content['link']}}" target="_blank" style="background-image: url({{$content['image']}})">
            <div class="widjet-banner__title">{!! $content['title'] !!}</div>
        </a>
    @endif
</div>
