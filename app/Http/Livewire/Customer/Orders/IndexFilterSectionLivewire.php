<?php

namespace App\Http\Livewire\Customer\Orders;

use App\Models\OrderStatusType;
use Illuminate\Support\Collection;
use Livewire\Component;

class IndexFilterSectionLivewire extends Component
{
    public int $status = 0;
    public int $count = 0;
    public int $countAll = 0;
    public string $title = '';

    protected $queryString = [
        'status' => ['except' => 0],
    ];

    public function render()
    {
        $statuses = $this->revalidateData();
        $this->countAll = $statuses->sum('ordersCount');
        $this->evaluateCurrentStatus($statuses);
        return view('livewire.customer.orders.index-filter-section-livewire', [
            'statuses' => $statuses,
        ]);
    }

    protected function revalidateData()
    {
        $user = auth()->user();

        return OrderStatusType::query()
            ->withTranslation()
//            ->whereHas('orders', fn($q) => $q->where('customer_id', $user->id))
            ->withCount(['orders as ordersCount' => fn($q) => $q->where('customer_id', $user->id)])
            ->get();
    }

    protected function evaluateCurrentStatus(Collection $statuses)
    {
        $found = $statuses->firstWhere('id', $this->status);
        if ($found){
            $this->title = $found->title;
            $this->count = $found->ordersCount;
        } else {
            $this->status = 0;
            $this->title = __('custom::site.all');
            $this->count =  $this->countAll;
        }
    }

    public function setFilter($status)
    {
        $this->status = $status;
        $this->emit('eventSetOrdersFilter', $status);
    }

}
