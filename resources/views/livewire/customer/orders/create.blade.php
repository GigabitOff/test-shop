<x-app-layout body-classes="lk-orders" :title="__('custom::site.create_order')">
    <main class="page-main lk-orders">
        @include('livewire.customer.widget.lk-head-widget')
    <div class="lk-page --order-creat">
        <div class="container-xl">
            <div class="lk-page__inner">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.create_order')"/>
                </div>
                <div class="lk-page__content">
                    <div class="lk-page__head --justify">
                        <h1 class="lk-page__title">@lang('custom::site.create_order')</h1>
                        <div class="da"></div>
                    </div>
                    <livewire:customer.orders.create-block-search-livewire/>
                    <livewire:customer.orders.create-block-order-livewire/>
                </div>
            </div>
        </div>
    </div>
    </main>
    @push('show-data')
        {{--        <x-modal-form id="modal-upload-exel">--}}
        {{--            <livewire:forms.upload-excel-livewire/>--}}
        {{--        </x-modal-form>--}}

        {{--        // Массовое наполнение товаров  --}}
{{--        <x-modal-form id="modal-bulk-upload-products" wrapperClass="modal-upload-files">--}}
{{--            <livewire:forms.bulk-upload-order-products-livewire/>--}}
{{--        </x-modal-form>--}}

{{--        <x-modal-form id="modal-result-upload-file" class="modal-xl">--}}
{{--            <livewire:forms.bulk-upload-product-list-livewire/>--}}
{{--        </x-modal-form>--}}
    @endpush
</x-app-layout>
