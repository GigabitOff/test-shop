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
                    <div class="lk-menu">
                        <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.users')"/>
                    </div>
                </div>
                <div class="lk-page__content">
                    <div class="lk-page__head">
                        <div class="lk-page__title">@lang('custom::site.users')</div>
                        <div class="switcher">
                            <a class="@if('customer.users.index' === Route::currentRouteName()) active @endif" href="{{route('customer.users.index')}}">@lang('custom::site.by_list')</a>
                            <a class="@if('customer.users.relation' === Route::currentRouteName()) active @endif" href="{{route('customer.users.relation')}}">@lang('custom::site.by_relation')</a>
                        </div>
                    </div>
                    <livewire:customer.users.index-filter-row-livewire/>
                    <livewire:customer.users.index-content-livewire/>
                </div>
            </div>
        </div>
    </div>

    @push('show-data')

    <div class="modal fade" id="modal-customer-edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            {{-- Форма редактирования пользователя --}}
            <livewire:forms.customer.customer-edit-livewire/>
        </div>
    </div>

    @endpush

</x-app-layout>
