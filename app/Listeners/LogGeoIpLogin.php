<?php

namespace App\Listeners;

class LogGeoIpLogin
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
    public function handle($event)
    {
        $location = geoip(request()->ip());
        if (!$location['default'] && $event->user->isCustomer) {
            $event->user->geoip()->updateOrCreate([
                'ip' => request()->ip(),
                'latitude' => $location['lat'],
                'longitude' => $location['lon'],
            ]);
        }
    }
}
