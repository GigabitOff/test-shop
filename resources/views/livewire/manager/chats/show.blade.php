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
                        <div class="lk-page-header__left">
                            <a class="decor-link decor-link--left" href="{{route('manager.chats.index')}}">
                                <span><span class="ico_arrow-l"></span>@lang('custom::site.return')</span>
                            </a>
                            <div class="lk-page-title">@lang('custom::site.messages')</div>
                        </div>
                    </div>
                    <livewire:manager.chats.show-content-section-livewire :chat="$chat"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
