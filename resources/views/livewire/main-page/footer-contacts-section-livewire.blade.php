<div class="page-footer__top-right">
    <ul class="page-footer__contacts">
        @if($settingAddresses)
        @foreach ($settingAddresses as $item)
            <li>
                <a href="{{'https://www.google.com/maps?q='.$item->coords_latitude.','.$item->coords_latitude}}"
                   target="_blank">{{isset($item->getCity) ? $item->getCity->title .',' : ''}}{{isset($item->address_lang) ? $item->address_lang : ''}}</a>
                   @php
                       $phones = json_decode($item->phones,true);
                   @endphp
                   @if(!empty($phones) )
                   @foreach ($phones as $item_ph)

                <a href="tel:{{ clearPhoneNumber($item_ph) }}"
                   target="_blank">{{ $item_ph }}</a>
                   @endforeach
                   @endif

            </li>
        @endforeach
        @endif
    </ul>
</div>
