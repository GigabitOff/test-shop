<x-app-layout body-classes="lk-compare" :title="__('custom::site.comparisons')">
    <div class="lk-page">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.comparisons')"/>
                </div>
                <livewire:customer.comparisons.page-main-livewire/>
            </div>
        </div>
    </div>
</x-app-layout>
