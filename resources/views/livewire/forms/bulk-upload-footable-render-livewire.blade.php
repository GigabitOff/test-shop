<table class="js-table footable footable-3 breakpoint-lg" data-paging="false" data-show-toggle="true"
       data-toggle-column="last" style="">
    <thead>
    <tr class="footable-header">
        <th class="text-center footable-first-visible" style="display: table-cell;">№</th>
        <th class="text-center" style="display: table-cell;">@lang('custom::site.article')</th>
        <th style="display: table-cell;">@lang('custom::site.status')</th>
        <th data-breakpoints="xs" style="display: table-cell;">@lang('custom::site.product_name')</th>
        <th data-breakpoints="xs" class="footable-last-visible"
            style="display: table-cell;">@lang('custom::site.quantity')</th>
    </tr>
    </thead>
    <tbody>

    @foreach($items as $item)
        <tr @if($item['notFounded']) class="no-result" @elseif($item['outOfStock']) class="deleted" @endif>
            <td class="text-center footable-first-visible" style="display: table-cell;">{{$loop->iteration}}</td>
            <td class="text-center" style="display: table-cell;">№ {{$item['sku']}}</td>
            <td style="display: table-cell;">{{$item['status']}}</td>
            <td style="display: table-cell;">{{$item['name']}}</td>
            <td class="footable-last-visible" style="display: table-cell;">{{$item['qty']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
