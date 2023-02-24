<x-app-layout body-classes="lk-messages">
    <div class="lk-page lk-page-messages">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.messages')"/>
                </div>
                <div class="lk-page__main">
                    <div class="lk-page-header">
                        <div class="lk-page-title">@lang('custom::site.write_message')</div>
                    </div>
                    <!-- Компонет таблицы чатов -->
                    <livewire:manager.chats.index-table-section-livewire/>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
