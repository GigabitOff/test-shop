<?php

namespace App\Http\Livewire\Manager\Widget;

use App\Models\Order;
use App\Models\OrderStatusType;
use App\Models\User;
use Livewire\Component;

class OrdersDirectorWidget extends Component
{
    protected ?User $user;

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        $counter = $this->getOrdersCounter();
        $orders = $this->revalidateOrderList();
        return view('livewire.manager.widget.orders-director-widget', [
            'counter' => $counter,
            'orders' => $orders,
        ]);
    }

    public function getOrdersCounter(): int
    {
        $ids = $this->getCustomerIds();
        return Order::query()
            ->whereIn('customer_id', $ids)
            ->whereRelation('status', 'id', OrderStatusType::STATUS_NEW)
            ->count();
    }

    public function revalidateOrderList()
    {
        $ids = $this->getCustomerIds();
        return Order::query()
            ->whereIn('customer_id', $ids)
            ->whereStatus(OrderStatusType::STATUS_NEW)
            ->with('status', 'customer')
            ->select('id', 'status_id', 'created_at', 'total', 'customer_id', 'payment_status')
            ->latest()
            ->limit(4)
            ->get();
    }

    protected function getCustomerIds()
    {
        static $ids;
        if (!$ids) {
            $ids = $this->user->customers()->pluck('id');
        }
        return $ids;
    }

    protected function getOrderStatusStyle(Order $order): string
    {
        switch ($order->status_id) {
            case OrderStatusType::STATUS_PROCESSING:
                $style = 'not-performed';
                break;
            case OrderStatusType::STATUS_CANCELED:
                $style = 'cancel';
                break;
            case OrderStatusType::STATUS_COMPLETED:
                $style = 'success';
                break;
            case OrderStatusType::STATUS_NEW:
            case OrderStatusType::STATUS_SHIPPING:
            case OrderStatusType::STATUS_ASSEMBLY:
            default:
                $style = 'success';
        }

        return $style;
    }

}
