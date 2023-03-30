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
                               data-value="{{isset($selectedData[$item->id])}}"
                               @if(isset($selectedData[$item->id])) checked @endif
                               onclick="@this.selectDataItem({{$item->id}})"/>
                        <span class="check__box"></span>
                    </label>
                    <a href="{{ route('admin.characteristics.edit', $item->id)}}">
                        {{$item->name}}
                    </a>
                </div>
            </td>
            <td class="text-end w-1">
                <a class="button button-small button-icon ico_edit"
                   href="@if(isset($canselSaveButton)){{'javascript:void(0);'}}@else{{ route('admin.characteristics.edit', [$item->id]) }}@endif"
         @if(isset($canselSaveButton))          onclick="document.menuLeft.showConfirmPopup('{{route('admin.characteristics.edit', [$item->id])}}')" @endif>
                </a>
            </td>

        </tr>
    @endforeach

    </tbody>
</table>
