<table>
    <thead>
    <tr>
        <th>№ / @lang('custom::site.date')</th>
        <th class="text-center">@lang('custom::site.debit')</th>
        <th class="text-center">@lang('custom::site.credit')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.debt')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.status')</th>
        <th class="text-md-center nowrap" data-breakpoints="xs">@lang('custom::site.reconciliation_act')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $act)
        <tr>
            <td>
                <span class="cell-number">№ {{$act->contract->registry_no}}</span>
                <span class="cell-date">{{$act->registry_no}} @lang('custom::site.from') {{formatDate($act->date_at)}}</span></td>
            <td class="text-center">
                <span class="cell-price px-0 text-lowercase">{{formatMoney($act->debit)}} @lang('custom::site.uah').</span>
                <span class="cell-date">{{formatDate($act->debit_date_at)}}</span>
            </td>
            <td class="text-center">
                <span class="cell-price px-0 text-lowercase">{{formatMoney($act->credit)}} @lang('custom::site.uah').</span>
                <span class="cell-date">{{formatMoney($act->credit_date_at)}}</span>
            </td>
            <td class="text-md-center">
                <span class="cell-price text-lowercase">{{formatMoney($act->debt)}} @lang('custom::site.uah').</span>
            </td>
            <td class="text-md-center">
                @php
                    $class = $act->isDocumentStatusApproved() ? 'success' : 'rejected';
                    $text = $act->isDocumentStatusApproved() ? __('custom::site.signed_it') : __('custom::site.not_signed_it');
                @endphp
                <span class="call-stat {{$class}}">
            <span class="ico_check"></span>
            <span>{{$text}}</span>
        </span>
            </td>
            <td class="text-md-center">
                @if($act->path)
                    <a class="cell-btn"
                       href="{{$act->fileUrl}}"
                       target="_blank">
                        <span class="ico_downloads"></span></a>
                @endif
                {{--        <a class="cell-btn" href="/assets/img/exsamle.pdf" target="_blank"><span class="ico_downloads"></span></a>--}}
            </td>
        </tr>
    @endforeach
    {{--<tr>--}}
    {{--    <td><a class="cell-number" href="lk-customer-documents-order.html">№658856-6</a><span class="cell-date">від 05.11.2020</span></td>--}}
    {{--    <td class="text-center"><span class="cell-price px-0">1 959,10 грн.</span><span class="cell-date">05.11.2020</span></td>--}}
    {{--    <td class="text-center"><span class="cell-price px-0">1 959,10 грн.</span><span class="cell-date">05.11.2020</span></td>--}}
    {{--    <td class="text-md-center"><span class="cell-price">1 959,10 грн.</span></td>--}}
    {{--    <td class="text-md-center"><span class="call-stat rejected"><span class="ico_check"></span><span>Не підписано</span></span></td>--}}
    {{--    <td class="text-md-center"><button class="cell-btn" type="button"><span class="ico_checkmark"></span></button></td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--    <td><a class="cell-number" href="lk-customer-documents-order.html">№658856-6</a><span class="cell-date">від 05.11.2020</span></td>--}}
    {{--    <td class="text-center"><span class="cell-price px-0">1 959,10 грн.</span><span class="cell-date">05.11.2020</span></td>--}}
    {{--    <td class="text-center"><span class="cell-price px-0">1 959,10 грн.</span><span class="cell-date">05.11.2020</span></td>--}}
    {{--    <td class="text-md-center"><span class="cell-price">1 959,10 грн.</span></td>--}}
    {{--    <td class="text-md-center"><span class="call-stat success"><span class="ico_check"></span><span>Підписано</span></span></td>--}}
    {{--    <td class="text-md-center"><a class="cell-btn" href="/assets/img/exsamle.pdf" target="_blank"><span class="ico_downloads"></span></a></td>--}}
    {{--</tr>--}}
    </tbody>
</table>
