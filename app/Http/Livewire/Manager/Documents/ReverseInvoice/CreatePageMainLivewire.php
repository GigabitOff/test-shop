<?php

namespace App\Http\Livewire\Manager\Documents\ReverseInvoice;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Document;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class CreatePageMainLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    public Order $order;
    public array $checked = [];
    public bool $showAll = false;

    protected ?User $customer;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-buttons';

    protected $listeners = [
        'eventCreateReverseInvoice'
    ];

    public function boot()
    {
        $this->customer = auth()->user();
    }

    public function mount(Request $request)
    {
        $this->order = $request->order;
    }

    public function render()
    {
        if ($this->revalidateTable) {
            $this->dispatchBrowserEvent('updateFooData');
        }

        $products = $this->revalidateProducts();

        $totals = $this->calculateTotals();

        $table = view('livewire.manager.documents.reverse-invoice.create-footable-render', [
            'products' => $products,
        ])->render();

        return view(
            'livewire.manager.documents.reverse-invoice.create-page-main-livewire',
            [
                'products' => $products,
                'table' => $table,
                'totals' => $totals,
            ]
        );
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateTable = true;
    }

    /** Service Functions */

    protected function revalidateProducts()
    {
        $products = $this->showAll
            ? $this->searchQuery()->get()
            : $this->searchQuery()->paginate($this->getPerPageValue());

        $collection = ($products instanceof LengthAwarePaginator)
            ? $products->getCollection()
            : $products;

        $collection->each(function (Product $product) {
                $product->orderQuantity = $product->pivot->quantity;
                $product->orderPrice = $product->pivot->price;
                $product->orderCost = $product->orderQuantity * $product->orderPrice;
                $product->checked = array_key_exists($product->id, $this->checked);
                $product->checkedQty = $this->checked[$product->id]['quantity'] ?? 0;
            });

        return $products;
    }

    private function searchQuery()
    {
        return $this->order->products()
            ->withTranslation()
            ->with(['mainImage', 'categories.images']);
    }

    public function eventCreateReverseInvoice($message)
    {
        if (!$this->checked) {
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.returning'),
                'message' => __('custom::site.choice_products'),
                'state' => 'warning'
            ]);
            return;
        }

        $document = new Document();
        $document->order_id = $this->order->id;
        $document->type = Document::TYPE_REVERSE_INVOICE;
        $document->status = Document::STATUS_PROCESSED;
        $document->total_with_nds = collect($this->checked)->sum('cost');
        $document->response = $message;

        $document->save();

        $document->products()->sync(
            collect($this->checked)->map(function ($checked) {
                return [
                    'quantity' => $checked['quantity'],
                    'price_nds' => $checked['price'],
                    'total_nds' => $checked['cost'],
                ];
            })
        );

        $this->emit('eventSaveDocumentImages', $document->id);
    }

    public function setChecked($productId, $checked, $value)
    {
        $productId = (int)$productId;

        if (!$checked) {
            unset($this->checked[$productId]);
            return;
        }

        if ($product = $this->order->products->find((int)$productId)) {
            $this->addProductToChecked($product, $value);
        }
    }

    public function setCheckedAll($checked)
    {
        if ($checked) {
            $this->order->products
                ->each(function ($product) {
                    $value = $product->pivot->quantity;
                    $this->addProductToChecked($product, $value);
                });

        } else {
            $this->checked = [];
        }

        $this->showAll = $checked;
        $this->revalidateTable = true;
    }

    protected function addProductToChecked(Product $product, $value)
    {
        $quantity = min($value, $product->pivot->quantity);
        $price = $product->pivot->price;

        $this->checked[$product->id] = [
            'quantity' => $quantity,
            'price' => $price,
            'cost' => $price * $quantity
        ];
    }

    public function setQuantity($productId, $quantity)
    {
        $productId = (int)$productId;

        if (in_array($productId, array_keys($this->checked))) {
            if ($product = $this->order->products->find((int)$productId)) {
                $checked = $this->checked[$productId];

                $quantity = min($quantity, $product->pivot->quantity);
                $price = $product->pivot->price;

                $checked['quantity'] = $quantity;
                $checked['cost'] = $price * $quantity;

                $this->checked[$productId] = $checked;
            }
        }
    }

    protected function calculateTotals(): array
    {
        return [
            'quantity' => array_sum(array_column($this->checked, 'quantity')),
            'cost' => array_sum(array_column($this->checked, 'cost')),
        ];
    }
}
