<table>
    <thead>
    <tr>
        <th class="w-lg-35">
            <div class="d-flex align-items-center">{{--<label class="check js-select-all"><input class="check__input" type="checkbox" /><span class="check__box"></span></label>--}}<span>@lang('custom::admin.Name filial')</span></div>
        </th>
        <th data-breakpoints="xs">@lang('custom::admin.Address')</th>
        <th class="w-1" data-breakpoints="xs">@lang('custom::admin.Order')</th>
        <th class="w-1" data-breakpoints="xs"></th>
    </tr>
    </thead>
    <tbody>
        @php
            $L=1;
        @endphp
    @foreach ($data_paginate as $key=>$item)
        <tr>
            <td>
                <div class="d-flex align-items-center">{{--<label class="check"><input class="check__input" type="checkbox" /><span class="check__box"></span></label>--}}
                    <span>
                        {{ $item->title }}
                    </span>
                </div>
                </td>
                <td><span>{{ $item->getCity !== null ? $item->getCity->title.', ' : '' }}{{ $item->address_lang }}</span></td>
                <td class="text-center"><input class="form-control form-xs" type="number" onclick="this.select();" onchange="chaneOrderAddress({{ $L }},this.value)" placeholder="1" value="{{ $L }}"></td>
                <td class="w-1 text-end"><button class="button button-small button-icon ico_trash" type="button" onclick="@this.destroyData({{ $L }});"></button></td>
        </tr>

        @php
            $L++;
        @endphp
    @endforeach

    </tbody>
</table>
