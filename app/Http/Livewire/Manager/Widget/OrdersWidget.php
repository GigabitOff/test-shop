<?php

namespace App\Http\Livewire\Manager\Widget;

use App\Models\Order;
use App\Models\OrderStatusType;
use App\Models\User;
use Livewire\Component;

class OrdersWidget extends Component
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
        return view('livewire.manager.widget.orders-widget', [
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
        $limit = $this->user->hasRole('director') ? 4 : 3;
        return Order::query()
            ->whereIn('customer_id', $ids)
            ->with('status')
            ->select('id', 'status_id', 'created_at', 'total')
            ->latest()
            ->limit($limit)
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
