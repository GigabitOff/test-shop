<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Modules\Cart\CartBySession;
use Illuminate\Auth\Events\Login;

class CopyCartWhenLogin
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
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $sessionCart = app()->make(CartBySession::class);

        $sessionCart->products()
            ->each(function ($pr) {
                cart()->setQuantity($pr->id, $pr->cartQuantity);
                cart()->checkProduct($pr->id, true);
            });

        $sessionCart->clear();
    }
}
