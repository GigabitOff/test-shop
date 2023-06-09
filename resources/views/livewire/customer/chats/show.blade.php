<x-app-layout body-classes="lk-messages" :title="__('custom::site.messages')">
    <main class="page-main lk-messages">
        @include('livewire.customer.widget.lk-head-widget')
        <div class="lk-page --messages">
            <div class="container-xl">
                <div class="lk-page__inner">
                    <div class="lk-page__sidebar">
                        <!-- Виджет меню -->
                        <livewire:widgets.cabinet.menu-widget/>
                    </div>

                    <!-- Компонет чата -->
                    <livewire:customer.chats.show-content-section-livewire :chat="$chat"/>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
