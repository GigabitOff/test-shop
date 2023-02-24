<x-app-layout body-classes="lk-documents" :title="__('custom::site.documents')">
    <div class="lk-page lk-page-documents">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.documents')"/>
                </div>
                <!-- Page content -->
                <livewire:manager.documents.index-page-main-livewire/>
            </div>
        </div>
    </div>
</x-app-layout>
