<div class="lk-page__action">
    <div class="lk-page__submenu">
        <div class="submenu">
            <div class="submenu__title">Показать:</div><button class="submenu__btn" type="button"><a class="lk-submenu__link" href="#!"><span class="lk-submenu__title">Всі</span><span class="lk-submenu__number">34</span></a></button>
            <div class="submenu__box">
                <ul class="lk-submenu">
                    <li class="lk-submenu__item"><a class="lk-submenu__link" wire:click="setDisplay('all')"
                                                    href="javascript:void(0);"><span class="lk-submenu__title">@Lang('custom::site.all')</span><span class="lk-submenu__number">{{$count_all}}</span></a></li>
                    <li class="lk-submenu__item"><a class="lk-submenu__link" wire:click="setDisplay('moderation')"
                                                    href="javascript:void(0);"><span class="lk-submenu__title">@lang('custom::site.moderation')</span><span class="lk-submenu__number">{{$count_moderation}} </span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="lk-page__action-btns">
        <div class="drop --search">
            <span class="drop-clear"></span><input class="form-control drop-input" type="text"
                                                   placeholder="@lang('custom::site.search')"
                                                   wire:model.debounce.700ms="search"
                                                   onfocusout="document.customeDropdown.hideDropdown(this)"
                                                   name="search"/>
            @if(!empty($search_list))
                <div class="drop-box"
                     style="display:@if('search' === $mode)block @else none @endif ;">
                    <div class="drop-overflow">
                        <ul class="drop-list">
                            @foreach($search_list as $id => $user)
                                <li class="drop-list-item" wire:click="setFilteredSearch({ id:{{$id}},value:'{{$user['name']}}' })"
                                    title="{{$user['name']}}">{{$user['name']}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div><a class="button-outline" href="#m-add-user" data-bs-toggle="modal">Додати користувача</a>
    </div>
</div>
<div class="lk-page__table">
    <div id="footable-content" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
    <table id="footable-holder"  class="table-td-small table-user table-with-table-inner"
           data-show-toggle="true" data-empty=""
           data-toggle-column="last" wire:ignore></table>
    <div class="lk-page__table-after">
        <div></div>
        <div>
            @include('livewire.includes.per-page-table', ['data_paginate' => $counterparties])
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
        window.addEventListener('eventUpdateContractUsers', (e) => {
            console.log(e)
            const contract = e.detail.contract;
            const html = e.detail.html;

            $(`.table-inner__row.contract-${contract}`)
                .find('.table-inner__cell .dropdown-menu')
                .html(html);
        });

        document.usersRelation = {
            approve: function(id) {
                @this.approveCounterparty(id);
            }
        }
        //# sourceURL=user-relation.js
    </script>
@endpush
