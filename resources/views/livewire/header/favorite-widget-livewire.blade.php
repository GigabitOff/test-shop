<div class="shop-action__favorites">
    <a class="shop-action__favorites-link"

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
        <div class="shop-action__favorites-icon ico_favorites"></div>
        <div class="shop-action__favorites-col">{{$count}}</div>
    </a>
</div>
