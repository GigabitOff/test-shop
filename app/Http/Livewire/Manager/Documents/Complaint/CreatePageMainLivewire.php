<?php

namespace App\Http\Livewire\Manager\Documents\Complaint;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Document;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class CreatePageMainLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    public Order $order;
    public array $checked = [];

    protected ?User $manager;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-buttons';

    protected $listeners = [
        'eventCreateComplaintInvoice'
    ];

    public function boot()
    {
        $this->manager = auth()->user();
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

        $table = view('livewire.manager.documents.complaint.create-footable-render', [
            'products' => $products,
        ])->render();

        return view(
            'livewire.manager.documents.complaint.create-page-main-livewire',
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
        $products = $this->searchQuery()->paginate($this->getPerPageValue());

        $products->getCollection()->each(function (Product $product) {
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

    public function eventCreateComplaintInvoice($message)
    {
        if (!$this->checked) {
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.complaint_act'),
                'message' => __('custom::site.choice_products'),
                'state' => 'warning'
            ]);
            return;
        }

        $document = new Document();
        $document->order_id = $this->order->id;
        $document->type = Document::TYPE_COMPLIANT;
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

    public function setChecked($productId, $checked)
    {
        $productId = (int)$productId;

        if (!$checked) {
            $this->checked = [];
            return;
        }

        if ($product = $this->order->products->find((int)$productId)) {
            $this->addProductToChecked($product);

            $this->emit('eventSetProductInfo', [
                'name' => $product->name,
                'sku' => $product->articul,
            ]);
        }
    }

    public function onShowModal()
    {
        if ($this->checked) {
            $this->dispatchBrowserEvent('showModal', [
                'modalId' => 'modal-act-complaint'
            ]);
        } else {
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.complaint_act'),
                'message' => __('custom::site.choice_products'),
                'state' => 'warning'
            ]);
        }
    }

    protected function addProductToChecked(Product $product)
    {
        $quantity = 1;
        $price = $product->pivot->price;

        $this->checked[$product->id] = [
            'quantity' => $quantity,
            'price' => $price,
            'cost' => $price * $quantity
        ];
    }

    protected function calculateTotals(): array
    {
        return [
            'quantity' => array_sum(array_column($this->checked, 'quantity')),
            'cost' => array_sum(array_column($this->checked, 'cost')),
        ];
    }
}
