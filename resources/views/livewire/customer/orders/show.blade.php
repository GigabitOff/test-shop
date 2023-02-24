<x-app-layout body-classes="lk-order" :title="__('custom::site.order')">

    <main class="page-main lk-order">
        @include('livewire.customer.widget.lk-head-widget')
        <div class="lk-page --order-return">
            <div class="container-xl">
                <div class="lk-page__inner">
                    <div class="lk-page__sidebar">
                        <livewire:widgets.cabinet.menu-widget/>
                    </div>
                        <livewire:customer.orders.show-content-livewire :order="$order"/>
                </div>
            </div>
        </div>

    </main>
    @push('show-data')
        <x-modal-form id="m-print-order" wrapperClass="m-print-order" class="modal-lg">
            <livewire:forms.print-order-livewire :order="$order"/>
        </x-modal-form>

{{--    // ToDo: подключить модалки рекламаций и возвратов--}}

{{--        <!-- Модальное окно актов рекламаций -->--}}
{{--        <x-modal-form id="modal-invoice-download" wrapperClass="modal-invoice-download" class="modal-xl">--}}
{{--            <livewire:forms.act-complaint-download-livewire/>--}}
{{--        </x-modal-form>--}}

{{--        <!-- Модальное окно возвратных накладных -->--}}
{{--        <x-modal-form id="modal-act-complaint-download">--}}
{{--            <livewire:forms.act-reverse-download-livewire/>--}}
{{--        </x-modal-form>--}}
    @endpush
</x-app-layout>
