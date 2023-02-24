<?php

namespace App\Http\Livewire\Manager\Widget;

use App\Models\Counterparty;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ReceivablesWidget extends Component
{
    protected ?User $manager;

    public function boot()
    {
        $this->manager = auth()->user();
    }
    public function mount()
    {
    }

    public function render()
    {
        $totalCount = $this->debtorCount();
        $debtors = $totalCount
            ? $this->revalidateDebtors()
            : [];

        return view('livewire.manager.widget.receivables-widget',
            compact('debtors', 'totalCount')
        );
    }

    protected function debtorCount(): int
    {
        return $this->debtorsQuery()->count();
    }

    public function revalidateDebtors()
    {
        // Непосредственно выбираем должников с максимальными суммами просрочки.
        return $this->debtorsQuery()
            ->select('counterparties.id', 'counterparties.name', 'counterparties.phone')
            ->selectRaw('SUM(cd.overdue_sum) as overdue_sum')
            ->selectRaw('SUM(cd.debt_sum) as debt_sum')
            ->selectRaw('MAX(cd.overdue_days) as overdue_days')
            ->groupBy('id')
            ->orderBy('overdue_sum', 'desc')
            ->take(3)->get();
    }

    public function debtorsQuery(): Builder
    {
        // Формируем запрос который выбирает должников с просрочкой.
        $sub = $this->manager->customers()->select('id')->toRawSql();
        return Counterparty::query()
            ->whereInRaw('founder_id', $sub);
    }
}
