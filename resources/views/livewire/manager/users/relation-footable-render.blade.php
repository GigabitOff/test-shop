<table>
    <thead>
    <tr>
        <th>№</th>
        <th class="text-md-center">@lang('custom::site.counterparty')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.responsible_person')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.phone')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.position')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.edrpou')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.company_type')</th>
        <th class="text-end w-1" data-breakpoints="xs"></th>
        <th data-breakpoints="all"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($counterparties as $counterparty)
        @php
            $founder = $counterparty->founder ?? new \App\Models\User();
            $changes = $founder->changes ?? null;
            $counterparty_type = $counterparty->isCustomType
                ? $counterparty->custom_type
                : $counterparty->type->name;
        @endphp

        <tr class="table-row --footable">
            <td>
                <div class="table-row__cell table-row__cell--column">
                    <span class="table-row__number">№ {{$loop->iteration + $iterated}}</span>
                    <span
                        class="table-row__date">@lang('custom::site.from') {{formatDate($counterparty->created_at)}}</span>
                </div>
            </td>
            <td>
                <div class="table-row__cell">
                    <div class="table-row__input table-row__input--strong">{{$counterparty->name}}</div>
                </div>
            </td>
            <td>
                <div class="table-row__cell">
                    <div class="table-row__label" data-label="@lang('custom::site.responsible_person')"></div>
                    @if(isset($changes->name))
                        <div class="table-row__input changed-mark">{{$changes->name}}</div>
                    @else
                        <div class="table-row__input">{{$founder->name ?? ''}}</div>
                    @endif
                    {{--                    <span class="table-row__date">@lang('custom::site.admin_group')</span>--}}
                </div>
            </td>
            <td>
                <div class="table-row__cell">
                    <div class="table-row__label" data-label="Телефон"></div>
                    @if(isset($changes->phone))
                        <div class="table-row__input changed-mark">{{formatPhoneNumber($changes->phone)}}</div>
                    @else
                        <div class="table-row__input">{{formatPhoneNumber($founder->phone ?? '')}}</div>
                    @endif
                </div>
            </td>
            <td>
                <div class="table-row__cell">
                    @if(isset($changes->position))
                        <div class="table-row__input changed-mark">{{$changes->position}}</div>
                    @else
                        <div class="table-row__input">{{$founder->position ?? ''}}</div>
                    @endif
                </div>
            </td>
            <td>
                <div class="table-row__cell">
                    <div class="table-row__label" data-label="@lang('custom::site.edrpou')"></div>
                    <div class="table-row__input">{{formatEdrpouNumber($counterparty->okpo)}}</div>
                </div>
            </td>
            <td>
                <div class="table-row__cell">
                    <div class="table-row__label" data-label="@lang('custom::site.company_type')"></div>
                    <div class="table-row__input">{{$counterparty_type}}</div>
                </div>
            </td>
            <td class="w-1">
                <div class="table-row__cell">
                    <div class="table-row__label"></div>
                    <div class="table-row__btns">
                        @if('all' === $display)
                            <div class="action-group action-group--table">
                                <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                <div class="action-group-drop action-group-drop--table">
                                    <button class="js-hide-drop ico_close" type="button"></button>
                                    <ul>
                                        {{--                           User Add    --}}
                                        <li><a href="javascript:void(0);"
                                               onclick="document.lazyWireModal.uploadAndShow('modal-customer-add',
                                                   {'force':true, payload:{leader_id:{{$founder->id ?? 0}}, counterparty_id:{{$counterparty->id}} } })"
                                               class="js-edit">@lang('custom::site.user_add')</a>
                                        </li>
                                        {{--                            Counterparty Add    --}}
                                        <li><a href="javascript:void(0);"
                                               onclick="document.lazyWireModal.uploadAndShow('modal-counterparty-create', {'force':true, payload:{leader_id:{{$founder->id ?? 0}} } })"
                                               class="js-edit">@lang('custom::site.counterparty_add')</a>
                                        </li>
                                        {{--                            Change Founder    --}}
                                        <li><a href="javascript:void(0);"
                                               onclick="document.lazyWireModal.uploadAndShow('modal-change-founder', {'force':true, payload:{counterparty_id:{{$counterparty->id}} } })"
                                               class="js-edit">@lang('custom::site.do_change_founder')</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @elseif('not_approved' === $display)
                            <div class="action-group action-group--table">
                                <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                <div class="action-group-drop action-group-drop--table">
                                    <button class="js-hide-drop ico_close" type="button"></button>
                                    <ul>
                                        {{--   Show Detail and Approve Counterparty modal  --}}
                                        <li><a href="javascript:void(0);"
                                               onclick="document.lazyWireModal.uploadAndShow('modal-counterparty-approve', {'force':true, payload:{counterparty_id:{{$counterparty->id}} } })"
                                               class="js-edit">@lang('custom::site.approve')</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </td>
            <td>
                <div class="table-inner">
                    @foreach($counterparty->contracts as $contract)
                        <div class="table-inner__row contract-{{$contract->id}}">
                            <div class="table-inner__cell">
                                <div class="table-row__numb">№ {{$loop->iteration}}</div>
                            </div>
                            <div class="table-inner__cell">
                                <div class="table-row__text">
                                    <div>{{$contract->registry_no}}</div>
                                    <div>{{$contract->name}}</div>
                                </div>
                            </div>
                            <div class="table-inner__cell">
                                <div class="table-row__text">
                                    <div>@lang('custom::site.address')</div>
                                    <div>{{$contract->address}}</div>
                                </div>
                            </div>
                            <div class="table-inner__cell">
                                <div class="table-row__text">
                                    <div>@lang('custom::site.phone')</div>
                                    <div>{{formatPhoneNumber($contract->phone)}}</div>
                                </div>
                            </div>
                            <div class="table-inner__cell">
                                <div class="table-row__btns">
                                    <div class="dropdown dropdown-user">
                                        <button class="button button-primary dropdown-toggle" type="button"
                                                data-toggle="dropdown">@Lang('custom::site.users')
                                        </button>
                                        <div class="dropdown-menu">
                                            @include('livewire.manager.users.includes.contract-users', [$contract])
                                        </div>
                                    </div>
                                    <button class="button button-icon"
                                            onclick="document.lazyWireModal.uploadAndShow('modal-customer-connect', {'force':true, payload:{contract_id:{{$contract->id}}}})"
                                            type="button"><span class="ico_plus"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
