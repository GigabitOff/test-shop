<?php

namespace App\Http\Livewire\Customer\Orders;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\User;
use App\Models\DeliveryType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTableSectionLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    public int $status = 0;
    public string $search = '';

    protected ?User $user;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-buttons';

    protected $queryString = [
        'status' => ['except' => 0],
    ];
    protected $listeners = [
        'eventSetOrdersFilter',
        'eventSetPayOrder',
    ];

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        $orders = $this->revalidateData();

        return view(
            'livewire.customer.orders.index-table-section-livewire', [
                'orders' => $orders,
            ]
        );
    }

    public function updatedSearch()
    {
        $this->revalidateTable = true;
    }

    public function resetSearch()
    {
        $this->reset('search');
        $this->revalidateTable = true;
    }

    protected function revalidateData(): LengthAwarePaginator
    {
        $data = $this->searchQuery()->paginate($this->getPerPageValue());

        $data->getCollection()->each(function ($data) {

            $data->deliveryIcon = $data->deliveryAddress
            ? $this->deliveryIcons($data->deliveryAddress->deliveryType)
            : '';
        });

        return $data;
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateTable = true;
    }

    public function eventSetOrdersFilter($newFilter)
    {
        $this->status = $newFilter;
        $this->reset('search');
        $this->resetPage();
    }

    public function eventSetPayOrder($orderId, $redirect)
    {
        $this->redirect(route('payment.liqpay', ['order' => $orderId, 'redirect' => $redirect]));
    }

    /** Служебные функции */

    private function searchQuery()
    {
        $orders = $this->user->orders();
        $documents_order = $orders->clone();

        $query = $orders->with('products', 'paymentType',
                        'deliveryAddress.deliveryType')
                        ->orderBy('id', 'desc');

        // ToDo: сделать через жадную загурзку
        $this->documents = $documents_order->join('documents', 'documents.order_id',
                               '=', 'orders.id')
                               ->select('orders.id', 'documents.path',
                               'documents.filename')->get();

        if ($this->status) {
            $query = $query->where('status_id', $this->status);
        }

        if ($value = trim($this->search)) {
            $query->where(function ($q) use ($value) {
                $q->where('id', 'like', "%{$value}%")
                    ->orWhere('ttn', 'like', "%{$value}%")
                    ->orWhere('comment', 'like', "%{$value}%")
                    ->orWhereHas('products', function ($q) use ($value) {
                        $q->whereTranslationLike('name', "%{$value}%");
                    })
                    ->orWhereHas('paymentType', function ($q) use ($value) {
                        $q->whereTranslationLike('name', "%{$value}%");
                    })
                    ->orWhereHas('recipient', function ($q) use ($value) {
                        $q->where('name', 'like', "%{$value}%");
                        $q->orWhere('inn', 'like', "%{$value}%");
                    })
                    ->orWhereHas('deliveryAddress', function ($q) use ($value) {
                        $q->where('address_full', 'like', "%{$value}%");
                        $q->orWhere('city_name', 'like', "%{$value}%");
                        $q->orWhere('street_name', 'like', "%{$value}%");
                        $q->orWhereHas('deliveryType', function ($q) use ($value) {
                            $q->whereTranslationLike('name', "%{$value}%");
                        });
                        $q->orWhereHas('city', function ($q) use ($value) {
                            $q->where('name_uk', 'like', "%{$value}%");
                        });
                    });
                if ($date = strtotime($value)) {
                    $q->orWhereDate('created_at', date('Y-m-d', $date));
                }
                if ($sum = round(floatval(str_replace(',', '.', $value)), 2)) {
                    // find by part of float field "total"
                    $q->orWhereRaw(DB::Raw("CONVERT(Round(total,2), CHAR) LIKE '%$sum%'"));
                }

            });
        }

        return $query;
    }

    public function deliveryIcons(DeliveryType $deliveryType): string
    {
        switch (true) {
            case $deliveryType->isNovaPoshtaService():
                return '/assets/img/np.svg';
            case $deliveryType->isDeliveryAutoService():
                return '/assets/img/delGroup_logo.svg';
            case $deliveryType->isSatService():
                return '/assets/img/sat.svg';
            case $deliveryType->isAddressDeliveryService():
            case $deliveryType->isSelfPickupService():
                return '/assets/img/samovyvoz.svg';
            default:
                return '/assets/img/delivery-2.svg';
        }
    }

    public function isNeedRevalidateFootable(): bool
    {
        return $this->revalidateTable;
    }
}
