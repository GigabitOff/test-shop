<?php

namespace App\Listeners;

use App\Models\UserEntrance;
use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
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
     * @param Logout $event
     * @return void
     */
    public function handle(Logout $event)
    {
        if ($event->user) {
            $event->user->entrances()
                ->where('user_id', $event->user->id)
                ->where('IP', request()->ip())
                ->where('session_id', session()->getId())
                ->update(['logout_at' => now()]);
        }
    }
}
