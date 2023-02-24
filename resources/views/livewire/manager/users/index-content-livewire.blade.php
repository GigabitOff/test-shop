<livewire:manager.users.index-filter-row-livewire/>
<div class="lk-page__action">
    <div class="lk-page__submenu">
        <div class="submenu">
            <div class="submenu__title">Показать:</div><button class="submenu__btn" type="button"><a class="lk-submenu__link" href="#!"><span class="lk-submenu__title">Всі</span><span class="lk-submenu__number">34</span></a></button>
            <div class="submenu__box">
                <ul class="lk-submenu">
                    <li class="lk-submenu__item @if('all' === $display) active @endif"><a class="lk-submenu__link" wire:click="setDisplay('all')" href="javascript:void(0);"><span class="lk-submenu__title">@Lang('custom::site.all')</span><span class="lk-submenu__number">{{$count_all}}</span></a></li>
                    <li class="lk-submenu__item @if('new' === $display) active @endif"><a class="lk-submenu__link" wire:click="setDisplay('new')" href="javascript:void(0);"><span class="lk-submenu__title">@Lang('custom::site.new')</span><span class="lk-submenu__number">{{$count_new}}</span></a></li>
                    <li class="lk-submenu__item @if('changed' === $display) active @endif"><a class="lk-submenu__link" wire:click="setDisplay('change_info')" href="javascript:void(0);"><span class="lk-submenu__title">@lang('custom::site.change_info')</span><span class="lk-submenu__number">{{$count_change}}</span></a></li>
                    <li class="lk-submenu__item @if('moderation' === $display) active @endif"><a class="lk-submenu__link" wire:click="setDisplay('moderation')" href="javascript:void(0);"><span class="lk-submenu__title">@lang('custom::site.moderation')</span><span class="lk-submenu__number"> </span></a></li>
                    <li class="lk-submenu__item @if('deleted' === $display) active @endif"><a class="lk-submenu__link" wire:click="setDisplay('deleted')" href="javascript:void(0);"><span class="lk-submenu__title">@lang('custom::site.deleted')</span><span class="lk-submenu__number">{{$count_deleted}}</span></a></li>
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
        </div><a class="button-outline" href="#m-add-user" data-bs-toggle="modal">@lang('custom::site.user_add')</a>
    </div>
</div>
<div class="lk-page__table">
    <table class="ftable js-table" data-paging-size="5" data-show-toggle="true" data-toggle-column="last"
           data-empty="@lang('custom::site.data_is_absent')">
        <thead>
        <tr>
            <th>@lang('custom::site.date')</th>
            <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.responsible')</th>
            <th class="text-md-center">@lang('custom::site.counterparty')</th>
            <th class="text-md-center">@lang('custom::site.manager')</th>
            <th class="text-md-center">@lang('custom::site.date')</th>
            <th class="text-md-center" data-breakpoints="xs">E-mail</th>
            <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.edrpou')</th>
            <th data-breakpoints="xs"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            @php
                $changes = $customer->changes;
                $counterparties = $customer->counterparties()->onlyModerated()->get();
                $counterparty = $counterparties->first();
                $counterparty_name = $counterparty->name ?? '';
                $counterparty_okpo = $counterparty->okpo ?? '';
                $counterparty_names = $counterparty?$counterparties->except($counterparty->id)->pluck('name')->filter()->join(', '):'';
                $manager_name = $customer->manager->name ?? '';
            @endphp
            <tr>
                <td>
                    <a class="cell-number" href="javascript:void(0);">№ {{$loop->iteration + $iterated}}</a>
                    <span
                        class="cell-date">@lang('custom::site.from') {{formatDate($customer->created_at)}}</span>
                </td>
                <td class="text-md-center">
                    @if(isset($changes->name))
                        <span class="cell-user max-width changed-mark"
                              title="{{$changes->name}}">{{$changes->name}}</span>
                    @else
                        <span class="cell-user max-width"
                              title="{{$customer->name}}">{{$customer->name}}</span>
                    @endif
                    @if(isset($changes->phone))
                        <a class="cell-phone changed-mark"
                           href="tel:+{{$changes->phone}}">{{formatPhoneNumber($changes->phone)}}</a>
                    @else
                        <a class="cell-phone"
                           href="tel:+{{$customer->phone}}">{{formatPhoneNumber($customer->phone)}}</a>
                    @endif

                </td>
                <td class="text-md-center">
                    <strong class="cell-company max-width"
                            title="{{$counterparty_name}}">{{$counterparty_name}}</strong>
                    <span class="cell-contract-number">
                            <span style="color: inherit;">
                                <strong>{{$counterparty_names}}</strong>
                            </span>
                        </span>
                </td>
                <td class="text-md-center max-width" title="{{$manager_name}}"><span>{{$manager_name}}</span></td>
                <td>
                    <span class="cell-date">{{formatDate($customer->updated_at)}}</span>
                </td>
                <td class="text-md-center">
                    @if(isset($changes->email))
                        <a class="cell-email max-width changed-mark"
                           title="{{$changes->email}}"
                           href="mailto:{{$changes->email}}">{{$changes->email}}</a>
                    @else
                        <a class="cell-email max-width"
                           title="{{$customer->email}}"
                           href="mailto:{{$customer->email}}">{{$customer->email}}</a>
                    @endif

                </td>
                <td class="text-md-center">
                        <span title="{{formatEdrpouNumber($counterparty_okpo)}}"
                              class="max-width">{{formatEdrpouNumber($counterparty_okpo)}}</span>
                </td>
                <td class="w-1 text-end"><a class="button-table ico_edit" href="lk-user.html"></a></td>
            <!--<td class="text-right text-md-center">
                    <div class="cell-btns">
                        <div class="action-group action-group--table">
                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                            <div class="action-group-drop action-group-drop--table">
                                <button class="js-hide-drop ico_close" type="button"></button>
                                <ul>
                                    @if('deleted' === $display)
                {{--                                        <li><a href="javascript:void(0);"--}}
                {{--                                               onclick="@this.restoreCustomer({{$customer->id}})"--}}
                {{--                                               class="js-restore">@lang('custom::site.restore')</a>--}}
                {{--                                        </li>--}}
                {{--                                        <li><a href="javascript:void(0);"--}}
                {{--                                               onclick="@this.destroyCustomer({{$customer->id}})"--}}
                {{--                                               class="js-restore">@lang('custom::site.delete_permanently')</a>--}}
                {{--                                        </li>--}}
            @else
                <li><a href="javascript:void(0);"
                       onclick="document.lazyWireModal.uploadAndShow('modal-customer-edit', {'force':true, payload:{customer_id:{{$customer->id}}}})"
                                               class="js-edit">@lang('custom::site.edit')</a>
                                        </li>
                                        @if($customer->id != $leader->id)
                    <li><a class="js-del" href="javascript:void(0);"
                           onclick="document.customerUsersIndex.deleteCustomer({{$customer->id}})">@lang('custom::site.delete')</a>
                                            </li>
                                        @endif
            @endif
                </ul>
            </div>
        </div>
        <a class="cell-btn" href="{{route('manager.orders.index')}}"><span class="ico_angel-r"></span></a>
                    </div>

                </td>-->
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="lk-page__table-after">
    <div></div>
    <div>
        @include('livewire.includes.per-page-table', ['data_paginate' => $customers])
    </div>
</div>
@push('custom-scripts')
    <script>
        document.customerUsersIndex = {
            deleteCustomer: (id) => {
                const detail = {
                    prompt: '@lang('custom::site.delete_customer_permanently')',
                    emitYes: 'eventDeleteCustomerConfirm',
                    emitNo: '',
                    payload: {'customerId': id}
                }
                document.dispatchEvent( new CustomEvent('showModalPrompt', {detail: detail}));
            }
        }

    </script>
@endpush
