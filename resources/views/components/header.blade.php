<header class="page-header">
    <div class="container-xl">
        <div class="page-header__box">
            <div class="page-header__logo"><a class="logo" href="{{route('main')}}">
                    <img class="logo-full" src="/assets/img/logo.svg" alt="deks">
                    <img class="logo-icon" src="/assets/img/logo-icon.svg" alt="deks"></a>
            </div>

            <div class="page-header__left">
                <x-header-lang-switcher classes="page-header__lang"/>
                <x-header-phones-widget classes="page-header__phones"/>
            </div>

            <livewire:header.search-widget/>

            <div class="page-header__right">
                <livewire:header.avatar-widget/>

                <div class="page-header__shop-action">
                    <div class="shop-action">
                        <livewire:header.compare-widget-livewire/>
                        <livewire:header.cart-widget/>
                    </div>
                </div>

                <div class="page-header__menu-btn menu-btn js-menu-btn">
                    <span class="menu-btn__icon ico_menu"></span>
                </div>
            </div>
        </div>
    </div>
</header>
