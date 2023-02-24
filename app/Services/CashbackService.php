<?php

namespace App\Services;

use App\Models\Counterparty;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CashbackService
{

    /**
     * Доступный пользователю Кэшбек.
     *
     * @param User|null $user
     * @return float
     */
    public function getCashbackAvailable(?User $user): float
    {
        if ($user && $user->can_use_cashback) {
            $sub = $user->counterparties()->select('id')->toRawSql();
            $sums = Counterparty::query()
                ->whereInRaw('id', $sub)
                ->select([DB::raw('SUM(cashback) as total_cashback')])
                ->first();

            return $sums->total_cashback;
        }

        return 0;
    }

    /**
     * Списание Кэшбека. Используется при оформлении заказа.
     * @param User $user
     * @param float $value
     * @return void
     */
    public function expenseCashback(User $user, float $value)
    {
        // Todo: need program
    }

    /**
     * Отмена списания Кэшбека. Использвется при переоформлении заказа.
     * @param User $user
     * @param float $value
     * @return void
     */
    public function discardCashback(User $user, float $value)
    {
        // Todo: need program
    }
}
