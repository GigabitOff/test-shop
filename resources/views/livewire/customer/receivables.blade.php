<x-app-layout body-classes="lk-receivables" :title="__('custom::site.receivables')">
    <div class="lk-page lk-page-receivables">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.receivables')"/>
                </div>
                <livewire:customer.debts.page-main-livewire/>
            </div>
        </div>
    </div>
</x-app-layout>
