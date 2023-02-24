<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

class DeleteExpiredUserProxies
{
    public function __invoke()
    {
        DB::table('user_proxies')
            ->where('date_to', '<', now() )
            ->delete();
    }
}
