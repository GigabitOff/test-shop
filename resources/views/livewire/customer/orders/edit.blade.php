<x-app-layout body-classes="lk-cart" :title="__('custom::site.edit_order')">
    <div class="lk-page">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Menu widget -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.edit_order')"/>
                </div>
                <div class="lk-page__main">
                    {{-- Orders / Edit Order --}}
                    <livewire:customer.orders.edit-content-livewire :order="$order"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
