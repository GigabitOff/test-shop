<div class="hero-menu-wrap">
    <div class="hero-menu" data-aos="fade-up">
        <div class="hero-menu__container">

            <ul class="hero-menu__list">
                <li class="hero-menu__item hero-menu__item--parent catalog-full-btn"
                    data-aos="fade-right" data-aos-delay="800">
                    <a class="hero-menu__link" href="">
                        <span class="hero-menu__title">@lang('custom::site.Product catalog')</span>
                        <span class="hero-menu__icon ico_angle-right"></span>
                    </a>
                </li>
            </ul>

            <ul class="hero-menu__list">
                @foreach ($menuCategories as $menuCategory)
                    @if($category = $menuCategory->category)
                        <li class="hero-menu__item hero-menu__item--parent" data-aos="fade-right" data-aos-delay="900">
                            <a class="hero-menu__link"
                               href="{{ route('catalog.show',$category->slug)}}">
                                <span class="hero-menu__title">{{ $category->name }}</span>
                                <span class="hero-menu__icon ico_angle-right"></span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>

        </div>
    </div>

    {{-- submenu for main (first) category --}}
    <div class="hero-menu__submenu">

        @include('livewire.menu.menu-main-submenu-livewire')

        @include('livewire.widgets.brands.widget-brand-index-header-livewire')

    </div>

    {{-- submenu for other six categies --}}

    @include('livewire.menu.menu-main-categories-livewire')

</div>
