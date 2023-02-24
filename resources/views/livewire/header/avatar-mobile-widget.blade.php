<div class="offcanvas-menu__user user-box dropdown">
    @if($user)
        <a class="user-box__link" href="lk-customer-index.html">
            <img class="user-box__avatar" src="{{$avatarUrl}}" alt="user"></a>
    @else
        <a data-toggle="modal" data-target="#modal-login" data-dismiss="modal"
           href="javascript:void(0);">{{__('custom::site.login')}}</a>
    @endif
</div>
