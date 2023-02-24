<x-app-layout body-classes="lk-users" :title="__('custom::site.users')">
    <div class="lk-head">
        <div class="container">
            <h3 class="text-center"><small>@lang('custom::site.nice_day'), {{ auth()->user()->name }}!</small>@lang('custom::site.your_account')</h3>
            <div class="lk-head-menu"></div>
        </div>
    </div>
    <div class="lk-page --users">
        <div class="container-xl">
            <div class="lk-page__inner">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <div class="lk-menu"><button class="lk-menu__btn"><span>{{__('custom::site.users')}}</span><span class="ico_arrow"></span></button>
                        <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.users')"/>
                    </div>
                </div>
                <div class="lk-page__content">
                    <div class="lk-page__head">
                        <div class="lk-page__title">@lang('custom::site.users')</div>
                        <div class="switcher">
                            <a class="@if('manager.users.index' === Route::currentRouteName()) active @endif"
                               href="{{route('manager.users.index')}}">@lang('custom::site.by_list')</a>
                            <a class="@if('manager.users.relation' === Route::currentRouteName()) active @endif"
                               href="{{route('manager.users.relation')}}">@lang('custom::site.by_relation')</a>
                        </div>
                    </div>
                    <livewire:manager.users.relation-content-livewire/>
                </div>
            </div>
        </div>
    </div>

    @push('show-data')

        <x-modal-form id="modal-counterparty-create">
            {{-- Форма создания контрагента --}}
            <livewire:forms.counterparty-create-livewire/>
        </x-modal-form>

        <x-modal-form id="modal-counterparty-edit">
            {{-- Форма редактирования контрагента --}}
            <livewire:forms.counterparty-edit-livewire/>
        </x-modal-form>

        <x-modal-form id="modal-customer-add">
            {{-- Форма добавления пользователя --}}
            <livewire:forms.customer-add-livewire/>
        </x-modal-form>

        <x-modal-form id="modal-customer-create">
            {{-- Форма создания пользователя --}}
            <livewire:forms.manager.customer-create-livewire/>
        </x-modal-form>

        <x-modal-form id="modal-customer-connect">
            {{-- Форма прикрепления пользователя к контракту --}}
            <livewire:forms.customer-connect-livewire/>
        </x-modal-form>

        <x-modal-form id="modal-change-founder">
            {{-- Форма прикрепления пользователя к контракту --}}
            <livewire:forms.counterparty-change-founder-livewire/>
        </x-modal-form>

    @endpush

</x-app-layout>
