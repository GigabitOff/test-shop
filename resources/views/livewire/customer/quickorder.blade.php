<x-app-layout body-classes="lk-favorites">
    <div class="lk-page lk-page-favorites">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    @livewire('widgets.cabinet.menu-widget', ['page_title' => 'quickorder'])
                </div>
                <div class="lk-page__main">
                    <h3>В работе (ожидается верстка)</h3>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
