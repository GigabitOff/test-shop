<div class="shop-action-item --cart" >
<a class="shop-action-item__link"

 @auth()

       @if(auth()->user()->isCustomer)
       href="{{ route('customer.cart')}}"

       @elseif(auth()->user()->isManager)
       href="{{ route('manager.cart')}}"

       @else
       href="javascript:void(0);"

       @endif

       @endauth

       @guest()
        href="#" data-bs-toggle="modal" data-bs-target="#m-login" data-bs-dismiss="modal"
       @endguest >
    <div class="shop-action-item__icon ico_cart"></div>
    <div class="shop-action-item__col">{{$quantity}}</div>
  </a>

</div>
