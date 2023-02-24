<x-app-layout body-classes="lk-user" :title="__('custom::site.edit_user')">
    <div class="lk-head">
        <div class="container">
            <h3 class="text-center"><small>@lang('custom::site.nice_day'), {{ auth()->user()->name }}!</small>@lang('custom::site.your_account')</h3>
            <div class="lk-head-menu"></div>
        </div>
    </div>
    <div class="lk-page --user">
        <div class="container-xl">
            <div class="lk-page__inner">
                <div class="lk-page__sidebar">
                    <div class="lk-menu">
                        <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.users')"/>
                    </div>
                </div>
                {{-- Users / Edit User --}}
                <livewire:customer.users.clients.user-clients-edit-livewire :item_id="$id"/>
            </div>
        </div>
    </div>
</x-app-layout>
