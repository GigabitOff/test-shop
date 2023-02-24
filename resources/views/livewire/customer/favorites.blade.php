<x-app-layout body-classes="lk-favorites" :title="__('custom::site.favorites')">
    <main class="page-main lk-waiting">
        @include('livewire.customer.widget.lk-head-widget')
        <div class="lk-page --waiting">
            <div class="container-xl">
                <div class="lk-page__inner">
                    <div class="lk-page__sidebar">
                        <livewire:widgets.cabinet.menu-widget />
                    </div>
                    <livewire:customer.favorites.index-content-livewire/>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
