<!-- Main Sidebar Container -->
<div class="page-sidebar__btn"><button type="button">
    <i class="ico_menu1"></i><span>
        {{ isset($title) ? $title : 'Меню'}}
    </span><i class="ico_angle-down"></i>
</button></div>
        <div class="page-sidebar__drop">
          <div class="page-sidebar__top">
            <div class="page-sidebar__lang">
              <ul>
                @foreach (App\Models\Language::where('status',1)->get() as $key=>$item)

                <li><a @if(\App::currentLocale()== $item->lang) class="active" @endif  href="{{ route('admin.index')}}/langchange/{{$item->lang}}">@lang('custom::admin.'.$item->lang.'_short')</a></li>

                @endforeach
              </ul>
            </div>
            <div class="page-sidebar__menu">
                @livewire('admin.partials.menu-left-livewire', key(time().'menu-left-livewire'))
            </div>
          </div>
          <div class="page-sidebar__bottom">
            <div class="page-sidebar__user">
            <div class="user-box">
                @if(Auth::guard('admin')->user())

                <div class="user-box__avatar"><img src="/admin/assets/img/avatar.png" alt="avatar">
                <div class="user-box__online"></div>
                </div>
                <div class="user-box__name">{{ Auth::guard('admin')->user()->name }}</div>
                <div class="user-box__position">@lang('custom::admin.role.'.\Auth::guard('admin')->user()->roles[0]->name)</div>

                <!-- Authentication -->
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <a href="{{ route('admin.logout') }}" class="user-box__exit"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="ico_exit"></i>
                            </a>

                        </form>
                @endif
            </div>

            </div>
            <div class="page-sidebar__copy"><span>@lang('custom::admin.Developed')<a href="https://fairtech.group/" target="_blank">Fairtech.Group ©</a>2022</span></div>
        </div>
</div>
