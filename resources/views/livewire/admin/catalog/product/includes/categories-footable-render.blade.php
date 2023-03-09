<table>
    <thead>
    <tr>
        <th>ID</th>
        <th class="w-100">
            <div class="d-flex align-items-center">
                <span>@lang('custom::admin.Name')</span>
            </div>
        </th>
        <th class="text-center" data-breakpoints="xs">@lang('custom::admin.Main')</th>
        <th class="text-end text-center w-1" data-breakpoints="xs"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data_paginate as $item)
        <tr>
            <td class="w-1">{{$item->id}}</td>
            <td class="w-100">
                <div class="box-services">
                    <a href="{{ route('admin.product.edit', $item->id)}}">
                        {{$item->name}}
                    </a>
                </div>
            </td>

            <td class="text-center">
                <span id="active{{$item->id}}" class="icon-status ico_checkmark mt-1 js-fee @if($mainCat == $item->id) is-active @endif " onclick="showMainCat('active{{$item->id}}')"
                        @click="$wire.setMainCategory({{$item->id}})"
                    ></span>
            </td>

            <td class="text-end w-1">
                <button class="button button-small button-icon ico_trash js-free"
                        @click="$wire.removeCategory({{$item->id}})"
                ></button>
            </td>

        </tr>
    @endforeach

    </tbody>
</table>
