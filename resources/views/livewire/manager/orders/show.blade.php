<x-app-layout body-classes="lk-order"  :title="__('custom::site.order')">
    <div class="lk-page">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.order')" />
                </div>
                <div class="lk-page__main --lk-order">
                    <div class="lk-page-header">
                        <div class="lk-page-header__left">
                            <a class="decor-link decor-link--left"
                               href="{{route('manager.orders.index')}}"><span><span
                                        class="ico_arrow-l"></span>@lang('custom::site.return')</span></a>
                            <div class="lk-page-title">@lang('custom::site.order')</div>
                        </div>
                    </div>
                    <livewire:manager.orders.show-table-section-livewire :order="$order" />
                </div>
            </div>
        </div>
    </div>
    @push('show-data')
        <x-modal-form id="modal-print-order" class="modal-xl  modal-print">
            <livewire:forms.print-order-livewire/>
        </x-modal-form>

        <!-- Модальное окно актов рекламаций -->
        <x-modal-form id="modal-invoice-download" wrapperClass="modal-invoice-download" class="modal-xl">
            <livewire:forms.act-complaint-download-livewire/>
        </x-modal-form>

        <!-- Модальное окно возвратных накладных -->
        <x-modal-form id="modal-act-complaint-download">
            <livewire:forms.act-reverse-download-livewire/>
        </x-modal-form>
    @endpush
</x-app-layout>
