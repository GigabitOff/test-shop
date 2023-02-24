<div class="page-header__menu offcanvas-menu">
    <div class="offcanvas-menu__close ico_close js-menu-close"></div>
    @if(false)
        <div class="offcanvas-menu__mobile">
            <div>
                <x-header-phones-widget classes="offcanvas-menu__phones phones-box dropdown js-dropdown-overlay"/>

                <x-header-lang-switcher classes="offcanvas-menu__lang lang-box dropdown js-dropdown js-dropdown-overlay"/>

            </div>
            <div>
                <div class="offcanvas-menu__shop-action shop-action">
                    <livewire:header.compare-widget-livewire/>

                    <livewire:header.favorite-widget-livewire/>
                </div>
    {{--            // Todo: нет кнопки выхода (разлогиниться).--}}
                    <livewire:header.avatar-mobile-widget/>
            </div>
        </div>
    @endif
    <div class="offcanvas-menu__box"><a class="logo" href="/"><img src="/assets/img/logo-white.svg" alt="deks"></a>
        <div class="offcanvas-menu__list">
            <ul class="offcanvas-menu-list">
                    <li class="offcanvas-menu-item">
                        <a class="offcanvas-menu-link">
                            <span>@lang('custom::site.Product catalog')</span>
                        </a>
                        @if($catalog)
                        <ul class="offcanvas-submenu-list">
                        @foreach ($catalog as $item_cat)
                        <li class="offcanvas-submenu-item">
                            <a class="offcanvas-submenu-link" href="{{ route('catalog.show', $item_cat->category->slug)}}">{{ isset($item_cat->category->name) ? $item_cat->category->name : '' }}</a>
                        </li>
                        @endforeach
                        </ul>
                        @endif
                    </li>
                    @if($data)
                    @foreach ($data as $item_data)
                    <li class="offcanvas-menu-item"><a class="offcanvas-menu-link" href="{{ Route::has($item_data->page->slug.'.index') ? route($item_data->page->slug.'.index') : route('pages.show', $item_data->page->slug)}}"><span>{{ $item_data->page->title }}</span></a>
                        @if($dataMenuCategory = $item_data->page->MenuCategory)
                    <ul class="offcanvas-submenu-list">
                        @foreach ($dataMenuCategory as $item_menu)
                        <li class="offcanvas-submenu-item offcanvas-submenu-item--active">
                            <a class="offcanvas-submenu-link" href="{{ route('catalog.show', $item_menu->category->id)}}">{{ isset($item_menu->category->name) ? $item_menu->category->name: '' }}</a>
                        </li>
                        @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
