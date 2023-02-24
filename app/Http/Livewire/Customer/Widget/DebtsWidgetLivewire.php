<?php

namespace App\Http\Livewire\Customer\Widget;

use App\Models\Counterparty;
use App\Models\CounterpartyDebt;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DebtsWidgetLivewire extends Component
{
protected ?User $customer;
    public $phone, $name_company;

    public function boot()
    {
        $this->customer = auth()->user();
    }

    public function render()
    {
        $debtor = $this->getLargestDebtor();
        $totals = $this->revalidateTotals();
        if($totals) {
            $totals['totalPercent'] = $totals['sumLimitSum']
                ? (int)(100 * ($totals['sumDebtSum'] / $totals['sumLimitSum']))
                : 0;
            $totals['totalRemainder'] = $totals['sumLimitSum'] - $totals['sumDebtSum'];
        }
        $totals['overduePercent'] = $debtor->debt_sum
            ? (int) (100 * ($debtor->overdue_sum/$debtor->debt_sum))
            : 0;

        $counterparty = $debtor->counterparty ?? new Counterparty();

        if ($user_company = $this->customer->counterparties->first())
            $this->name_company =$user_company->name;

        $this->phone=$this->customer->phone;

        return view('livewire.customer.widget.debts-widget-livewire',
            compact('totals', 'debtor', 'counterparty')
        );
    }

    public function revalidateTotals(): array
    {
        $sub = $this->customer->counterparties()->select('id')->toRawSql();


        return CounterpartyDebt::query()
            ->whereInRaw('counterparty_id', $sub)
            ->select([
                DB::Raw('`debt_sum` as `sumDebtSum`'),
                DB::Raw('`limit_sum` as `sumLimitSum`'),
//                DB::Raw('max(`limit_sum`) as `maxSumLimit`'),
//                DB::Raw('max(`limit_days`) as `maxDaysLimit`'),
//                DB::Raw('max(`overdue_days`) as `maxDaysOverdue`'),
//                DB::Raw('sum(`overdue_sum`) as `sumSumOverdue`'),
            ])
            ->first() ?? [];//->toArray();
    }

public function getLargestDebtor()
{
    $sub = $this->customer->counterparties()->select('id')->toRawSql();
    return CounterpartyDebt::query()
        ->whereInRaw('counterparty_id', $sub)
        ->orderBy('debt_sum', 'desc')
        ->firstorNew();
}
}