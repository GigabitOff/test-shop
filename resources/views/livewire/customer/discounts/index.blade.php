<x-app-layout body-classes="lk-bonus" :title="__('custom::site.discounts')">
    <main class="page-main lk-bonus">
        @include('livewire.customer.widget.lk-head-widget')
        <div class="lk-page --bonus">
            <div class="container-xl">
                <div class="lk-page__inner">
                    <div class="lk-page__sidebar">
                        <div class="lk-menu">
                            <livewire:widgets.cabinet.menu-widget/>
                        </div>
                    </div>
                    <livewire:customer.discounts.page-main-livewire/>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
