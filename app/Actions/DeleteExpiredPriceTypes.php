<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

class DeleteExpiredPriceTypes
{
    public function __invoke()
    {
        DB::table('counterparty_price_type_products')
            ->where('date_end', '<', now() )
            ->delete();

        DB::table('counterparty_price_type_groups')
            ->where('date_end', '<', now() )
            ->delete();
    }
}
