<div class="page-footer__top-right">
    <ul class="page-footer__contacts">
        @if($addressText)
            <li>
                <a href="{{$addressMap ?: 'javascript:void(0);'}}"
                   target="_blank">{{$addressText}}</a>
            </li>
        @endif
    </ul>
</div>
