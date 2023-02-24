<table>
    <thead>
    <tr>
        <th>@lang('custom::admin.products.Articul')</th>
        <th>@lang('custom::admin.Name')</th>
        <th data-breakpoints="xs">@lang('custom::admin.categories')</th>
        <th data-breakpoints="xs">@lang('custom::admin.Link')</th>
        <th class="text-end" data-breakpoints="xs"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data_paginate as $item)
        <tr>
            <td>
                <a class="accent" href="{{ route('admin.product.edit', $item->id)}}">
                    {{$item->articul}}
                </a>
            </td>

            <td>
                <span>{{$item->name}}</span>
            </td>
            <td>
                <span>{{$item->categoriesList}}</span>
            </td>
            <td>
                <a class="short-link accent"
                   href="{{route('products.show', $item->slug)}}"
                   target="_blank">{{route('products.show', $item->slug)}}</a>
            </td>

            <td class="text-end w-1">
                <a class="button button-small button-icon ico_edit"
                   href="{{ route('admin.product.edit', [$item->id]) }}">
                </a>
            </td>

        </tr>
    @endforeach

    </tbody>
</table>
