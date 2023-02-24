<x-app-layout body-classes="lk-index" :title="__('custom::site.cabinet')">

    <div class="lk-page lk-leader-index">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.main')"/>
                </div>
                <div class="lk-page__main">
                    <div class="row">
                        <div class="col-xxl-6 col-12">
                            <!-- Виджет заказов -->
                            <livewire:manager.widget.orders-director-widget/>
                        </div>
                        <div class="col-xxl-6 col-12">
                            <livewire:manager.widget.stat-product-sales-widget/>
                        </div>
                        <div class="col-12 mt-4 mb-4">
                            <livewire:manager.widget.geography-clients-widget/>
                        </div>
                        <div class="col-xxl-6 col-12 mb-4">
                            <livewire:manager.widget.stat-category-views-widget/>
                        </div>
                        <div class="col-xxl-6 col-12">
                            <livewire:manager.widget.stat-referrer-sources-widget/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('show-data')
        {{-- Форма рейтинга продаж товаров --}}
        <x-modal-form id="modal-search-products">
            <livewire:forms.stat-product-sales-livewire/>
        </x-modal-form>

        {{-- Форма списка источников перехода --}}
        <x-modal-form id="modal-search-links">
            <livewire:forms.stat-referrer-sources-livewire/>
        </x-modal-form>

        {{-- Форма списка просмотров категорий --}}
        <x-modal-form id="modal-view-visits">
            <livewire:forms.stat-category-views-livewire/>
        </x-modal-form>
    @endpush

    @push('before-scripts')
        <script
            src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB92cIFqw6xYpuZ7cfizeIwvgDZux3lqTA"></script>
    @endpush

</x-app-layout>
