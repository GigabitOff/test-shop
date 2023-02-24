<x-app-layout body-classes="lk-documents" :title="__('custom::site.my_documents')">
    <div class="lk-page lk-page-documents">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.my_documents')"/>
                </div>
                <!-- Page content -->
                <livewire:manager.documents.reverse-invoice.create-page-main-livewire/>
            </div>
        </div>
    </div>
    @push('show-data')
        <x-modal-form id="modal-print-order" class="modal-xl  modal-print">
            <livewire:forms.print-order-livewire/>
        </x-modal-form>
    @endpush
</x-app-layout>
