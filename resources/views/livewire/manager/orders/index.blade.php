<x-app-layout body-classes="lk-orders" :title="__('custom::site.orders')">
    <div class="lk-page lk-manager-orders">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.my_orders')"/>
                </div>
                <livewire:manager.orders.index-page-main-livewire/>
            </div>
        </div>
    </div>

    @push('show-data')

        <div class="modal fade" id="modal-order-delete-confirm" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                {{-- Форма подтверждения удаления заказа --}}
                @include('livewire.forms.order-delete-confirm')
            </div>
        </div>
    @endpush

</x-app-layout>
