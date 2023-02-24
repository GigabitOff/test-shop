{{--<div class="page-header__user user-box dropdown js-dropdown-overlay">
    <a class="user-box__link" href="javascript:void(0);" data-toggle="dropdown"><img
            class="user-box__avatar"
            src="{{$user_avatar}}"
            alt="user"><span class="user-box__name">{{$user_name}}</span></a>
    <div class="user-box__dropdown dropdown-menu">
        @if($user)
            @if($user->hasRole('customer'))

                    <div class="dropdown-item"><a href=""></a></div>
                @else
                    <div class="dropdown-item" style="white-space: initial;"><a data-toggle="modal" data-target="#modal-registration" data-dismiss="modal" href="#!">{!!__('custom::site.do_registration_complete')!!}</a></div>
                @endif
                <div class="dropdown-item"><a href="{{route('logout')}}">{{__('custom::site.logout')}}</a></div>
            @else
                <div class="dropdown-item"><a href="{{route('manager.dashboard')}}">{{__('custom::site.cabinet')}}</a></div>
                <div class="dropdown-item"><a href="{{route('logout')}}">{{__('custom::site.logout')}}</a></div>
            @endif
        @else
            <div class="dropdown-item">
                <a data-toggle="modal" data-target="#modal-login" data-dismiss="modal"
                   href="javascript:void(0);">{{__('custom::site.login')}}</a></div>
            <div class="dropdown-item">
                <a data-toggle="modal" data-target="#modal-registration" data-dismiss="modal"
                   href="javascript:void(0);">{{__('custom::site.registration')}}</a></div>
        @endif
    </div>
</div>--}}

<div class="page-header__user">
    <div class="user-box dropdown">
        <div class="user-box__link dropdown-toggle" data-bs-toggle="dropdown">
            <img class="user-box__avatar" src="/assets/img/user.svg" alt="user">
            <span class="user-box__name">{{$user_name}}</span>
        </div>
        @if($user)
            <div class="user-box__dropdown dropdown-menu">
                @if($user->isCustomerRegistered)
                    <a class="dropdown-item" href="{{route('customer.dashboard')}}">{{__('custom::site.cabinet')}}</a>
                @else
                    <a class="dropdown-item" href="{{route('manager.dashboard')}}">{{__('custom::site.cabinet')}}</a>
                @endif
                    <a class="dropdown-item" href="{{route('logout')}}">{{__('custom::site.logout')}}</a>
            </div>
        @else
            <div class="user-box__dropdown dropdown-menu">
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#m-login"
                   data-bs-dismiss="modal">{{__('custom::site.login')}}</a>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#m-registration"
                   data-bs-dismiss="modal">{{__('custom::site.registration')}}</a>
            </div>
        @endif
    </div>
</div>


