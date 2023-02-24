<div class="lw-relation-content">
    <div class="lk-page__action">
        <div class="lk-page__submenu">
            <div class="submenu">
                <div class="submenu__title">Показать:</div><button class="submenu__btn" type="button"><a class="lk-submenu__link" href="#!"><span class="lk-submenu__title">Всі</span><span class="lk-submenu__number">34</span></a></button>
                <div class="submenu__box">
                    <ul class="lk-submenu">
                        <li class="lk-submenu__item @if('all' === $display) active @endif"><a class="lk-submenu__link" wire:click="setDisplay('all')" href="javascript:void(0);"><span class="lk-submenu__title">@Lang('custom::site.all')</span><span class="lk-submenu__number">{{$count_all}}</span></a></li>
                       <!-- <li class="lk-submenu__item @if('new' === $display) active @endif"><a class="lk-submenu__link" wire:click="setDisplay('new')" href="javascript:void(0);"><span class="lk-submenu__title">@Lang('custom::site.new')</span><span class="lk-submenu__number">{{$count_new}}</span></a></li>
                        <li class="lk-submenu__item @if('changed' === $display) active @endif"><a class="lk-submenu__link" wire:click="setDisplay('changed')" href="javascript:void(0);"><span class="lk-submenu__title">@lang('custom::site.change_info')</span><span class="lk-submenu__number">{{$count_change}}</span></a></li>-->
                        <li class="lk-submenu__item @if('moderation' === $display) active @endif"><a class="lk-submenu__link" wire:click="setDisplay('moderation')" href="javascript:void(0);"><span class="lk-submenu__title">@lang('custom::site.moderation')</span><span class="lk-submenu__number">{{$count_moderation}}</span></a></li>
                        <!--<li class="lk-submenu__item @if('deleted' === $display) active @endif"><a class="lk-submenu__link" wire:click="setDisplay('deleted')" href="javascript:void(0);"><span class="lk-submenu__title">@lang('custom::site.deleted')</span><span class="lk-submenu__number">{{$count_deleted}}</span></a></li>-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="lk-page__action-btns">
            @include('livewire.includes.search-dropdown-live')
            <a class="button-outline" href="#modal-customer-add" data-bs-toggle="modal">@lang('custom::site.user_add')</a>
        </div>
    </div>

    <div class="lk-page__table">
        <div id="footable-content" style="display: none" data-table="{{ $table }}"></div>
        <table id="footable-holder"  class="ftable table-td-small table-user table-with-table-inner"
               data-show-toggle="true" data-empty="@lang('custom::site.data_is_absent')"
               data-toggle-column="last" wire:ignore></table>
        <div class="lk-page__table-after">
            <div></div>
            <div>
                @include('livewire.includes.per-page-table', ['data_paginate' => $customers])
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });
        });
        function showEditCounterparty(id){
            Livewire.emit('setCounterpartyId', id);
            $("#modal-counterparty-edit").modal('show');
        }
    </script>
@endpush
