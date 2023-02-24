<x-app-layout body-classes="lk-order-creat" :title="__('custom::site.create_order')">
    <div class="lk-page lk-page-manager-order-creat">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.create_order')"/>
                </div>
                <div class="lk-page__main">
                    <div class="lk-page-header">
                        <div class="lk-page-header__left">
                            <a class="decor-link decor-link--left" href="{{route('manager.orders.index')}}">
                                <span><span class="ico_arrow-l"></span>@lang('custom::site.return')</span>
                            </a>
                            <div class="lk-page-title">@lang('custom::site.create_order')</div>
                        </div>
                    </div>
                    <div class="lk-table">
                        <livewire:manager.orders.create-block-search-livewire/>
                        <livewire:manager.orders.create-block-order-livewire/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('show-data')
        {{--        --}}{{-- Форма загрузки файла --}}
        {{--        <x-modal-form id="modal-upload-exel">--}}
        {{--            <livewire:forms.upload-excel-livewire/>--}}
        {{--        </x-modal-form>--}}

        {{--         Форма создания покупателя --}}
        <x-modal-form id="modal-customer-create">
            <livewire:forms.manager.customer-create-livewire/>
        </x-modal-form>

        {{--        // Массовое наполнение товаров  --}}
        <x-modal-form id="modal-bulk-upload-products" wrapperClass="modal-upload-files">
            <livewire:forms.bulk-upload-order-products-livewire/>
        </x-modal-form>
        <x-modal-form id="modal-result-upload-file" class="modal-xl">
            <livewire:forms.bulk-upload-product-list-livewire/>
        </x-modal-form>

    @endpush
</x-app-layout>
