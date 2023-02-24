<table>
    <thead>
    <tr>
        <th class="text-center">@lang('custom::site.overdue')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.counterparty')</th>
        <th class="text-center">@lang('custom::site.contract')</th>
        <th class="text-center">@lang('custom::site.credit_limit')</th>
        <th class="text-md-center" data-breakpoints="xs">@lang('custom::site.postponement_days')</th>
        <th class="text-md-center" data-breakpoints="xs sm md">@lang('custom::site.debt')</th>
        <th class="text-md-center" data-breakpoints="xs sm md">@lang('custom::site.expected')</th>
        <th class="text-md-center" data-breakpoints="xs sm md">@lang('custom::site.Read more')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contracts as $contract)
        <tr class="table-row">
            <td class="text-center">
                @if($contract->overdue_days)
                    @php($days = numericCasesLang($contract->overdue_days, 'custom::site.day'))
                    <span class="cell-price accent">{{$contract->overdue_days}} {{$days}}</span>
                @endif
            </td>
            <td class="text-md-center">
                <strong class="cell-company">{{$contract->counterparty->name}}</strong>
                <span class="cell-phone">{{formatPhoneNumber($contract->counterparty->phone ?? '')}}</span>
            </td>
            <td class="text-center">
                <span>{{$contract->registry_no}}</span>
            </td>
            <td class="text-center"><strong class="text-lowercase">{{formatMoney($contract->limit_sum)}} @lang('custom::site.uah').</strong></td>
            <td class="text-md-center">
                @php($days = numericCasesLang($contract->limit_days, 'custom::site.day'))
                <span>{{$contract->limit_days}} {{$days}}</span>
            </td>
            <td class="text-xl-center">
                <span class="text-lowercase">{{formatMoney($contract->debt_sum)}} @lang('custom::site.uah').</span>
            </td>
            <td class="text-xl-center">
                <strong class="text-lowercase">{{formatMoney($contract->expected_sum ?? '')}} @lang('custom::site.uah').</strong>
                <span class="cell-date mt-2">{{formatDate($contract->expected_to)}}</span>
            </td>
            <td class="text-end text-xl-center"><a class="cell-btn" href="{{route('manager.debts', ['contract_id' => $contract->id])}}"><span class="ico_arrow-right-2"></span></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
