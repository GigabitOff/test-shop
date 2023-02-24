<?php

namespace App\Actions\Promotions;

use Illuminate\Support\Facades\DB;

class DeactivateOutdated
{
    public function __invoke()
    {
        DB::table('actions')
            ->where('date_end', '<', now() )
            ->update(['status' => 0]);
    }
}
