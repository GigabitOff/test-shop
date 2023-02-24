<?php

namespace App\Http\Livewire\Manager\Orders;

use App\Http\Livewire\Traits\WithPerPage;
use App\Http\Livewire\Traits\WithProductPersonalOffer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTableSectionLivewire extends Component
{
    use WithPagination;
    use WithPerPage;
    use WithProductPersonalOffer;

    /** Входящие данные */
    public Order $order;

    protected ?User $user;
    protected User $customer;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-buttons';

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function mount()
    {
        $this->customer = $this->order->customer;
    }

    public function render()
    {
        if ($this->revalidateTable) {
            $this->dispatchBrowserEvent('updateFooData');
        }

        $products = $this->prepareProducts();

        $table = view('livewire.manager.orders.show-footable-render', [
            'products' => $products,
        ])->render();

        return view(
            'livewire.manager.orders.show-table-section-livewire', [
                'products' => $products,
                'table' => $table,
            ]
        );
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateTable = true;
    }

    public function setEditOrder()
    {
        if (orders()->setOrderEdited($this->order->id)){
            $this->redirect(route('manager.orders.edit', ['order' => $this->order->id]));
        } else {
            $this->dispatchBrowserEvent(
                'flashMessage',
                [
                    'title' => __('custom::site.edit_order'),
                    'message' => __('custom::site.order_edit_error'),
                    'state' => 'danger'
                ]
            );
        }
    }

    /** Служебные функции */

    private function prepareProducts()
    {
        $query = $this->order->products()
            ->withTranslation()
            ->with('images', 'translation', 'categories.images');

        $products = $query->paginate($this->getPerPageValue());

        $products->getCollection()
            ->each(function (Product $product) {
                $product->orderPrice = $product->pivot->price;
                $product->orderQuantity = $product->pivot->quantity;
                $product->orderCost = $product->orderPrice * $product->orderQuantity;
                $product->orderTotalWeight = $product->weight * $product->orderQuantity;
                $product->orderTotalVolume = $product->volume * $product->orderQuantity;
                $product->isPersonalOffer = $this->isProductBelongOffer($product->pivot);
                $product->personalOfferId1c = $this->getPersonalOfferId1c($product->pivot);
            });

        return $products;
    }


}
