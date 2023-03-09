<table>
    <thead>
    <tr>
        <th class="w-100">
            <div class="d-flex align-items-center">
                <label class="check js-select-all js-select-all2">
                    <input class="check__input" type="checkbox"
                           id="check-row-all"
                           data-value="{{isset($selectedData['all'])}}"
                           @if($data_paginate->isEmpty()) disabled @endif
                           @if(isset($selectedData['all'])) checked @endif
                           onclick="@this.selectDataItem('all',true)"/>
                    <span class="check__box"></span>
                </label>
                <span>@lang('custom::admin.Name')</span>
            </div>
        </th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::admin.mandatory')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::admin.Activity')</th>
        <th class="text-end w-1" data-breakpoints="xs"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data_paginate as $item)
        <tr>
            <td class="w-100">
                <div class="box-services">
                    <label class="check">
                        <input class="check__input" type="checkbox"
                               @if(isset($selectedData[$item->id])) checked @endif
                               onclick="@this.selectDataItem({{$item->id}})"/>
                        <span class="check__box"></span>
                    </label>
                    <a href="{{ route('admin.characteristics.edit', $item->id)}}">
                        {{$item->name}}
                    </a>
                </div>
            </td>

            <td class="text-md-center">
                @if($item->basic)
                    <a class="button button-small button-icon ico_checkmark is-active"
                       href="javascript:void(0);">
                    </a>
                @endif
            </td>

            <td class="text-md-center">
                <label class="check eye">
                    <input class="check__input" type="checkbox"
                           @if($item->status == 0)  checked="checked" @endif
                           onclick="@this.changeStatus({{$item['id']}}, this.checked);"/>
                    <span class="check__box"></span>
                </label>
            </td>

            <td class="text-end w-1">
                <a class="button button-small button-icon ico_edit"
                   href="{{ route('admin.characteristics.edit', [$item->id]) }}">
                </a>
            </td>

        </tr>
    @endforeach

    </tbody>
</table>
