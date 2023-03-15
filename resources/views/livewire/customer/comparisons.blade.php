<x-app-layout body-classes="lk-compare" :title="__('custom::site.comparisons')">
    <main class="page-main lk-compare">
        @include('livewire.customer.widget.lk-head-widget')
        <div class="lk-page --compare">
            <div class="container-xl">
                <div class="lk-page__inner">
                    <div class="lk-page__sidebar">
                        <livewire:widgets.cabinet.menu-widget/>
                    </div>
                    <livewire:customer.comparisons.page-main-livewire/>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
