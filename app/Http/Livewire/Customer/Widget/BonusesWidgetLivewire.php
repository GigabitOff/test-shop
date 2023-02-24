<?php

namespace App\Http\Livewire\Customer\Widget;

use Livewire\Component;

class BonusesWidgetLivewire extends Component
{
    public function render()
    {
        $customer = auth()->user();
        $ordersTotal = $customer->orders()->sum('total');
        return view(
            'livewire.customer.widget.bonuses-widget-livewire',
            compact('customer', 'ordersTotal')
        );
    }

}
