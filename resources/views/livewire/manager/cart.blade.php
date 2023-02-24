<x-app-layout body-classes="lk-cart" :title="__('custom::site.cart')">
    <div class="lk-page">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.cart')"/>
                </div>
                <div class="lk-page__main">
                    <livewire:manager.cart.page-main-livewire/>
                </div>
            </div>
        </div>
    </div>
    @push('show-data')

        {{--         Форма создания покупателя --}}
        <x-modal-form id="modal-customer-create">
            <livewire:forms.manager.customer-create-livewire/>
        </x-modal-form>
    @endpush
</x-app-layout>
