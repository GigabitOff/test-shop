<table data-paging-size="7">
    <thead>
    <tr>
        <th>@lang('custom::site.date')</th>
        <th data-breakpoints="xs">@lang('custom::site.counterparty')</th>
        <th data-breakpoints="xs">@lang('custom::site.responsible_person')</th>
        <th data-breakpoints="xs">@lang('custom::site.phone')</th>
        <th data-breakpoints="xs sm md">@lang('custom::site.position')</th>
        <th data-breakpoints="xs sm md">@lang('custom::site.edrpou')</th>
        <th data-breakpoints="xs sm md">@lang('custom::site.company_type')</th>
        <th class="w-1"></th>
        <th data-breakpoints="all"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        @php

            $main_counterparty = $customer->counterparty;
            if($main_counterparty){
                $founder = $main_counterparty->founder ?? new \App\Models\User();
                $changes = $founder->changes;

                $counterparty_type = $main_counterparty->isCustomType
                    ? $main_counterparty->custom_type
                    : $main_counterparty->type->name;
            }
        @endphp
        @if($main_counterparty)
            <tr>
            <td>
                <div data-label="№ договору">
                    <div class="d-flex flex-column"><a href="lk-user.html"> № {{$loop->iteration}}</a><span class="small">{{formatDate($main_counterparty->created_at)}}</span></div>
                </div>
            </td>
            <td>
                <div class="table-row__cell">
                    <div class="table-row__input table-row__input--strong">{{$main_counterparty->name}}</div>
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
                    {{--<span class="table-row__date">@lang('custom::site.admin_group')</span>--}}
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
                    <div class="table-row__input">{{formatEdrpouNumber($main_counterparty->okpo)}}</div>
                </div>
            </td>
            <td>
                <div class="table-row__cell">
                    <div class="table-row__label" data-label="@lang('custom::site.company_type')"></div>
                    <div class="table-row__input">{{$counterparty_type}}</div>
                </div>
            </td>
            <td class="w-1">
                <div class="action-group">
                    <div class="action-group-btn"><span class="ico_submenu"></span></div>
                    <div class="action-group-drop">
                        <ul class="action-group-list">
                            <li><button type="button" onclick="showEditCounterparty({{$main_counterparty->id}})"><span class="ico_edit"></span></button></li>
                            <li><button type="button"><span class="ico_trash"></span></button></li>
                            <li><button class="js-hide-drop" type="button"><span class="ico_close"></span></button></li>
                        </ul>
                    </div>
                </div>
            </td>
            <td>
                <div class="table-inner">
                    @foreach($customer->counterparties()->get() as $counterparty)
                        <div class="table-inner__row user-{{$counterparty->id}}">
                            <div class="table-inner__cell"><span>№ {{$loop->iteration}}</span></div>
                            <div class="table-inner__cell"><span>{{$counterparty->name}}</span></div>
                            <div class="table-inner__cell">
                                <div class="d-flex flex-column"><span class="nowrap">ТОВ Назва</span><span class="nowrap small">{{formatEdrpouNumber($counterparty->okpo)}}</span></div>
                            </div>
                            <div class="table-inner__cell">
                                <div class="d-flex flex-column">
                                    <span class="nowrap">{{formatPhoneNumber($counterparty->phone)}}</span>
                                    <span class="nowrap small">Адреса</span>
                                </div>
                            </div>
                            <div class="table-inner__cell">
                                <span>
                                    @php
                                      $contracts = implode('<br>№ ',$counterparty->contracts()->pluck('registry_no')->toArray());
                                    @endphp
                                    {!! $contracts ? "№ ".$contracts: '' !!}
                                </span>
                            </div>
                            <div class="table-inner__cell">
                                <div>
                                    <div class="button-group">
                                        @if(!empty($counterparty->users()->get()))
                                            <div class="tagger">
                                                <input class="form-control" type="hidden" placeholder="Додати хештег" value="sdfsdf,dfsdfsdf" hidden="hidden">
                                                <ul>
                                                    @foreach ($counterparty->users()->get() as $item_user)
                                                        <li>
                                                            <a href="javascript: void(0);" class="--yellow">
                                                                <span class="label text-black">{{$item_user->name}}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach

                                                    <li class="tagger-new">
                                                        <input class="js-tags-next-2" onkeypress="return addNewTags2(event)" placeholder="@lang('custom::site.Related users')" >
                                                        <div class="tagger-completion"></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <input class="js-tags-2 form-control" onkeypress="return addNewTagsFirst2(event,this.value)" type="text" placeholder="@lang('custom::site.Related users')" value = "">
                                        @endif
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><button type="button" onclick="showEditCounterparty({{$counterparty->id}})"><span class="ico_edit"></span></button></li>
                                                    <li><button type="button" data-bs-toggle="modal" data-bs-target="#m-add-customer"><span class="ico_plus"></span></button></li>
                                                    <li><button class="js-hide-drop" type="button"><span class="ico_close"></span></button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>
