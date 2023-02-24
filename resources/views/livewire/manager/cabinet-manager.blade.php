<x-app-layout body-classes="lk-index" :title="__('custom::site.cabinet')">
    <div class="lk-page lk-manager-index">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.main')"/>
                    <div class="lk-widjet lk-widjet-user--sidebar" data-da=".lk-widjet-user-mobile, 1679">
                        <livewire:manager.widget.personal-data-widget/>
                    </div>
                </div>
                <div class="lk-page__main">
                    <div class="row">
                        <div class="col-xxl-6 col-12 mb-4">

                            <!-- Виджет заказов -->
                            <livewire:manager.widget.orders-widget/>
                            <!-- Виджет рекламаций -->
                            <livewire:manager.widget.complaints-widget/>
                        </div>
                        <div class="col-xxl-6 col-12">
                            <!-- Виджет новых пользователей -->
                            <livewire:manager.widget.new-users-widget/>
                            <!-- Виджет дебиторская задолженность -->
                            <livewire:manager.widget.receivables-widget/>
                        </div>
                        <div class="col-12">
                            <div class="lk-widjet-user-mobile"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
