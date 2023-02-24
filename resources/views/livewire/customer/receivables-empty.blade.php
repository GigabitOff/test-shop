<x-app-layout body-classes="lk-receivables" :title="__('custom::site.receivables')">
    <div class="lk-page lk-page-receivables">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.receivables')"/>
                </div>
                <div class="lk-page__main">
                    <div class="lk-page-header">
                        <div class="lk-page-title">@lang('custom::site.receivables')</div>
                    </div>
                    <div>
                        <span>У Вас нет кредитного лимита. Обратитесь к Вашему менеджеру</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
