<x-app-layout body-classes="lk-cart" :title="__('custom::site.cart')">
    <main class="page-main">
        <div class="lk-page">
            <div class="container container-xl">
                <div class="lk-page__box">
                    <div class="lk-page__main" style="width: 100%;">
                        {{-- Client /Customer Cart --}}
                        <livewire:customer.cart.unregistered.page-main-livewire />

                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
