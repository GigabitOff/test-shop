<div class="page-footer__top-left">
    @php($barcode = settingsData('img_barcode_footer_single',true))
        @if($barcode)
        <div class="page-footer__qrcode">
            <img src="{{\Storage::disk('public')->url($barcode)}}" alt="qrcode"></div>
    @endif
  <div><a class="logo" href="/"><img src="/assets/img/logo-white.svg" alt="desk"></a>
    <ul class="page-footer__submenu">
    @if($menu = getPageItem('polityka-konfidenciynosti'))
      <li><a href="{{ route('polityka-konfidenciynosti') }}">{{$menu->title}}</a></li>
    @endif
      @if($menu = getPageItem('delivery-payment'))
      <li><a href="{{ route('delivery-payment') }}">{{$menu->title}}</a></li>
      @endif
      @if($menu = getPageItem('privacy-policy'))
      <li><a href="{{route('privacy-policy')}}">{{$menu->title}}</a></li>
      @endif
      @if($menu = getPageItem('site-terms'))
      <li><a href="{{ route('site-terms') }}">{{$menu->title}}</a></li>
      @endif
    @if($menu = getPageItem('contacts'))
      <li><a href="{{ route('contacts.index') }}">{{$menu->title}}</a></li>
    @endif
    </ul>
  </div>
</div>


    