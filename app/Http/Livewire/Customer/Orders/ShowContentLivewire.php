<?php

namespace App\Http\Livewire\Customer\Orders;

use App\Http\Livewire\Traits\WithPerPage;
use App\Http\Livewire\Traits\WithProductPersonalOffer;
use App\Http\Livewire\Traits\WithSearchDropdown;
use App\Models\Department;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ShowContentLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    /** Входящие данные */

    /** @var Order $order */
    public Order $order;
    public array $perPageListItems = [5, 10, 20, 30, 40];

    protected ?User $user;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-cabinet';

    public function boot()
    {
        $this->user = auth()->user();
    }

//    public function mount()
//    {
//        $this->prepareProducts();
//    }

    public function render()
    {
        $products = $this->prepareProducts();

        return view(
            'livewire.customer.orders.show-content-livewire', [
                'products' => $products,
            ]
        );
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateTable = true;
    }

    public function setEditOrder()
    {
        if (orders()->setOrderEdited($this->order->id)) {
            $this->redirect(route('customer.orders.edit', ['order' => $this->order->id]));
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

    public function sendCallbackToMe()
    {
        try {
            DB::beginTransaction();

            $chat = $this->user->chats()->create([
                'manager_id' => $this->user->manager_id,
                'department_id' => $this->user->manager_id ? null : Department::TYPE_GLOBAL,
            ]);

            $chat->messages()->create([
                'message' => __('custom::site.callback_me_please'),
                'owner_id' => $this->user->id,
            ]);

            DB::commit();
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.new_message_to_manager'),
                'message' => __('custom::site.send_message_success'),
                'state' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());

            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.new_message_to_manager'),
                'message' => __('custom::site.send_message_error'),
                'state' => 'danger'
            ]);
        }
    }

    /** Служебные функции */

    private function prepareProducts()
    {
        $query = $this->order->products()
            ->withTranslation()
            ->with(['mainImage', 'translation', 'categories']);

        $products = $query->paginate($this->getPerPageValue());

        $products->getCollection()
            ->each(function (Product $product) {
                $product->orderPrice = $product->pivot->price;
                $product->orderQuantity = $product->pivot->quantity;
                $product->orderCost = $product->orderPrice * $product->orderQuantity;
                $product->orderTotalWeight = $product->weight * $product->orderQuantity;
                $product->orderTotalVolume = $product->volume * $product->orderQuantity;
                $product->categoryName = $product->categories->first()->name ?? '';

                $this->expandProductStatus($product);
            });

        return $products;
    }

    protected function expandProductStatus(Product $product)
    {
        if ($product->on_backorder){
            $product->statusText = __('custom::site.on_backorder');
            $product->statusCss = '--status-1';
        } elseif ($this->order->isNotPaid()) {
            $product->statusText = __('custom::site.in_reserve');
            $product->statusCss = '--status-2';
        } else {
            $product->statusText = __('custom::site.availability_exist');
            $product->statusCss = '--status-3';
        }
    }

    public function isNeedRevalidateFootable(): bool
    {
        return $this->revalidateTable;
    }

    public function isShowProductStatusColumn(): bool
    {
        return $this->order->isNotPaid() && $this->order->isStatusProcessing();
    }

    public function isShowProductReturningColumn(): bool
    {
        return $this->order->isStatusCompleted() && $this->order->hasReverses;
    }

}
