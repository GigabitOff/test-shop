{{--<div class="shop-action__compare">
    <a class="shop-action__compare-link"

       @auth()

       @if(auth()->user()->isCustomer)
       href="{{ route('customer.comparisons')}}"

       @else
       href="javascript:void(0);"

       @endif

       @endauth

       @guest()
       data-toggle="modal" data-target="#modal-registration" data-dismiss="modal"
       href="javascript:void(0);"
        @endguest

    >
        <div class="shop-action__compare-icon ico_compare"></div>
        <div class="shop-action__compare-col"></div>
    </a>
</div>--}}

<div class="shop-action-item --compare">
<a class="shop-action-item__link"

@auth()
       @if(auth()->user()->isCustomer)
       href="{{ route('customer.comparisons')}}"

       @endif
@endauth

 @guest()

 href="#" data-bs-toggle="modal" data-bs-target="#m-login"
                   data-bs-dismiss="modal" 
 @endguest >

  <div class="shop-action-item__icon ico_compare"></div>
  <div class="shop-action-item__col">{{$count}}</div>
</a></div>