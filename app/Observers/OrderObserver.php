<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderStatusType;

class OrderObserver
{
    /**
     * Handle the Order "updating" event.
     *
     * @param Order $order
     * @return void
     */
    public function updating(Order $order)
    {
        if ($order->isDirty('status_id') &&
            $order->status_id === OrderStatusType::STATUS_COMPLETED ) {

            foreach ($order->products as $product) {
                $product->increment('sales');
            }
        }
    }
}
