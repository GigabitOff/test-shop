<table>
    <thead>
    <tr>
        <th class="w-100">
            <div class="d-flex align-items-center">
                <label class="check js-select-all">
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
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::admin.Activity')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::admin.Order')</th>
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
                    <span class="accent">{{$item->id}}</span>
                    <a href="{{ route('admin.services.edit', $item->id)}}">
                        {{$item->translate(session('lang'))->title ?? $item->title}}
                    </a>
                </div>
            </td>

            <td class="text-md-center">
                <label class="check eye">
                    <input class="check__input" type="checkbox"
                           @if($item->status == 0)  checked="checked" @endif
                           onclick="@this.changeStatus({{$item['id']}}, this.checked);" />
                    <span class="check__box"></span>
                </label>
            </td>

            <td class="text-md-center w-1">
                <input class="form-control form-xs" type="number"
                       data-value="{{ $item->order }}"
                       value="{{ $item->order }}"
                       onchange="@this.setModelOrder({{$item->id}}, this.value)">
            </td>

            <td class="text-end w-1">
                @if(isset($action_type))
                    <button type="button"
                            class="button button-small button-icon ico_edit"
                            wire:click="editDataItem('{{ $item->id }}')">
                        @lang('custom::admin.Edit')
                    </button>
                @else
                    <a class="button button-small button-icon ico_edit"
                       href="{{ route('admin.services.edit', [$item->id]) }}">
                    </a>
                @endif
            </td>

        </tr>
    @endforeach

    </tbody>
</table>
