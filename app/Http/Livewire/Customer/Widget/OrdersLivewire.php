<?php

namespace App\Http\Livewire\Customer\Widget;

use App\Models\Order;
use App\Models\OrderStatusType;
use App\Models\User;
use Livewire\Component;

class OrdersLivewire extends Component
{
    protected ?User $user;

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        $orders = $this->user->orders()->with(['status'])
            ->select('id', 'status_id', 'created_at', 'total')
            ->latest()->limit(3)->get();

        return view('livewire.customer.widget.orders-livewire', [
            'orders' => $orders,
        ]);
    }

    protected function getOrderStatusStyle(Order $order): string
    {
        switch ($order->status_id) {
            case OrderStatusType::STATUS_NEW:
                return 'new-order';
            case OrderStatusType::STATUS_PROCESSING:
                return 'at-work';
            case OrderStatusType::STATUS_ASSEMBLY:
                return 'equipment';
            case OrderStatusType::STATUS_SHIPPING:
                return 'delivered';
            case OrderStatusType::STATUS_COMPLETED:
                return 'completed';
            case OrderStatusType::STATUS_CANCELED:
                return 'cancel';
            case OrderStatusType::STATUS_DRAFT:
            case OrderStatusType::STATUS_EDITED:
                return 'edited';
            default:
                return 'success';
        }
    }

}
