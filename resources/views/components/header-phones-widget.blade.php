<div class="{{$classes}}">
    @php
        $phones_top = settingsDataCategory('phones_top','all');
        $tmp = [];
        $first_phone = '';

        if(isset($phones_top) AND count($phones_top)>0):

            foreach ($phones_top as $key2 => $value2) {
                if($value2->status_phone == 'not_logged_in' && !Auth::check()){
                    $tmp[$value2['category_phone']][$key2] = $value2;
                    if($first_phone == '') $first_phone = $value2->value;
                }
                if(Auth::check()){
                    if($value2->status_phone == 'signed_in_wholesale' && Auth::user()->isCustomerLegalAdmin){
                        $tmp[$value2['category_phone']][$key2] = $value2;
                        if($first_phone == '') $first_phone = $value2->value;
                    }elseif($value2->status_phone == 'retail_is_logged_in' && Auth::user()->isCustomerSimple){
                        $tmp[$value2['category_phone']][$key2] = $value2;
                        if($first_phone == '') $first_phone = $value2->value;
                    }else{
                        if($value2->status_phone != 'not_logged_in'){
                            $tmp[$value2['category_phone']][$key2] = $value2;
                            if($first_phone == '') {$first_phone = $value2->value;}
                        }
                    }
                }
            }

            $phones_top = $tmp;
    @endphp


    <div class="phones-box dropdown">
    <div class="phones-box__current dropdown-toggle"
         data-bs-toggle="dropdown"><i class="ico_phone"></i>{!! $first_phone != '' ? $first_phone : '' !!}</div>
    <div class="phones-box__dropdown dropdown-menu">
        @foreach ($phones_top as $item_phone_cat)

                @php
                    $k=0;
                @endphp
                @foreach ($item_phone_cat as $item)
                    @if($k == 0 AND $item->getContuct !== null)
                        <div class="dropdown-menu__department">{{ $item->getContuct->title }}</div>
                    @endif
                    <a class="dropdown-item" href="tel:{{ preg_replace('![^0-9]+!', '', $item->value) }}">{!! $item->value !!}</a>
                    @php
                        $k++;
                    @endphp
                @endforeach
        @endforeach
    </div>
    @php
        endif;
    @endphp
    </div>
</div>
