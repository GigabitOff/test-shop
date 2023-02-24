<x-app-layout>
    <main class="page-main page-home">

        <section class="section-hero">
            <div class="container-xl">
                <div class="hero__inner">

                    @livewire('menu.menu-main-catalog-livewire',[ 'mainPage'=>$page])

                    @include('livewire.main-page.product-main-page-banner-livewire')
                </div>
            </div>
        </section>

        <section class="section-banner">
            <livewire:main-page.actions-section-livewire/>
        </section>

        @livewire('main-page.viewed-section-livewire')

        @livewire('banners.novelty-banner-livewire', ['banners'=>$banners])

        @livewire('main-page.delivery-section-livewire')

        <livewire:widgets.brands.widget-brand-index-livewire />

    </main>
</x-app-layout>
