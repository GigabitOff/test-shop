<?php

namespace App\Listeners;

use App\Models\UserEntrance;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class LogoutOtherWhenLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        try {
            DB::beginTransaction();

            UserEntrance::query()
                ->where('user_id', $event->user->id)
                ->where('IP', request()->ip())
                ->where('session_id', '!=', session()->getId())
                ->update(['logout_at' => now()]);


            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('user_id', $event->user->getAuthIdentifier())
                ->where('id', '!=', session()->getId())
                ->delete();


            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
        }
    }
}
