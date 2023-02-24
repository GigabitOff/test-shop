<x-app-layout body-classes="lk-cart">
    <main class="page-main">
        <div class="lk-page">
            <div class="container container-xl">
                <div class="lk-page__box">
                    <div class="lk-page__sidebar">
                        <!-- Виджет меню -->
                        @livewire('widgets.cabinet.menu-widget', ['page_title' => __('custom::site.cart')])
                    </div>
                    <div class="lk-page__main">
                        {{-- Client /Customer Cart --}}
                        @livewire('test-checkboxes-livewire')

                    </div>
                </div>
            </div>
        </div>
    </main>


</x-app-layout>
