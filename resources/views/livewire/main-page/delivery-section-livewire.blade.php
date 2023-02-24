<section class="section-delivery">
  <div class="container-xl position-relative --decor">
    <div class="row g-0">
      <div class="col-xxl-4 col-xl-4 col-md-7">
        <div class="delivery-desc" data-aos="fade-right" data-aos-delay="200" data-aos-duration="300">
          <h3 class="section-title">{{$pageDelivery->title ?? ''}}</h3>
          {!! $pageDelivery->description !!}<a class="button-outline" href="{{ route('delivery-payment') }}">@lang('custom::site.Detail')</a>
        </div>
      </div>
      <div class="col-xxl-2 col-xl-3 col-md-5">
        <div class="delivery-info" data-aos="fade-down" data-aos-duration="300">
          <ul>
          @php($title_1 = settingsData('delivery_payment_title_1',true))
          @php($text_1 = settingsData('delivery_payment_text_1',true))
          @if( $title_1 !== null AND $title_1 !='')
            <li>
              <h5>@if($title_1) {{$title_1}} @else @lang('custom::site.Address delivery')@endif</h5>
              <span>{!! $text_1 !!}</span>
            </li>
            @endif
            @php($title_2 = settingsData('delivery_payment_title_2',true))
            @php($text_2 = settingsData('delivery_payment_text_2',true))
            @if($title_2  !== null  AND trim($title_2) !='')
            <li>
              <h5>@if($title_2) {{$title_2}} @else @lang('custom::site.Delivery service')@endif</h5>
              <span>{!! trim($text_2) !!}</span>
            </li>
            @endif
            <li>
            @php($title_3 = settingsData('delivery_payment_title_3',true))
            @php($text_3 = settingsData('delivery_payment_text_3',true))
            @if(settingsData('delivery_payment_title_3',true)  !== null  AND trim($title_3) !='')
              <h5>@if($title_3) {{$title_3}} @else @lang('custom::site.Self-pickup') @endif</h5>
              <span>{!! $text_3 !!}</span>
            </li>
            @endif
          </ul>
        </div>
      </div>
      <div class="col-xxl-6 col-xl-5 d-none d-xl-block">
        <div class="delivery-img" data-aos="fade-up" data-aos-duration="300"><img src="{{ \Storage::disk('public')->url($pageDelivery->image_banner) }}" alt="delivery"></div>
      </div>
    </div>
  </div>
</section>
