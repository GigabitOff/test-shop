<?php

namespace App\Http\Livewire\Customer\Favorites;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class IndexContentLivewire extends Component
{
    const PER_PAGE_DEFAULT = 10;

    use WithPagination;

    // Выбранные товары. id=>['checked'=>true, 'quantity' => 1, price=>2.5]
    public $selected = [];

    // Итоги ['sum'=>23.5, 'quantity'=>3]
    public $totals = [];

    public $selectAll = false;

    protected $paginationTheme = 'paginator-buttons';
    protected $updateTable = false;

    protected $listeners = [
        'eventFavouritesChanged',
    ];

    public function boot()
    {
    }

    public function render()
    {
        $products = $this->revalidateProducts();

        if ($this->updateTable) {
            $this->dispatchBrowserEvent('updateFooData');
        }

        $table = view('livewire.customer.favorites.index-footable-render', [
            'products' => $products,
            'selected' => $this->selected,
        ])->render();
        return view('livewire.customer.favorites.index-content-livewire', [
            'products' => $products,
            'table' => $table,
        ]);
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->updateTable = true;
    }

    public function setAllProductsChecked($checked)
    {
        foreach ($this->selected as &$item){
            $item['checked'] = (bool)$checked;
        }

        $this->updateTotals();
    }

    public function setProductChecked($id, $checked)
    {
        if (isset($this->selected[$id])){
            $this->selected[$id]['checked'] = (bool)$checked;
        }

        $this->updateTotals();
    }

    public function setProductQuantity($id, $quantity)
    {
        if (isset($this->selected[$id])){
            $this->selected[$id]['quantity'] = $quantity;
        }

        $this->updateTotals();
    }


    public function addToCart()
    {
        $checked = collect($this->selected)->filter->checked;
        if ($checked->isNotEmpty()) {

            if ($checkedUuids = cart()->checkedProductUuids()) {
                cart()->checkProducts($checkedUuids->toArray(), false);
            }

            foreach ($checked as $id => $item){
                cart()->addProduct($id, $item['quantity']);
                cart()->setQuantity($id, $item['quantity']);
                cart()->checkProduct($id, true);
            }

            $this->redirect(route('customer.cart'));
        }

    }

    public function setPerPage($value)
    {
        session()->put('perPage', $value);
        $this->resetPage();
        $this->updateTable = true;
    }

    /** События */

    public function eventFavouritesChanged()
    {
        $this->updateTable = true;
    }

    /** Служебные функции */

    private function revalidateProducts()
    {
        $query = Product::query()->whereIn('id', favourites()->productIds());

        $perPage = session()->get('perPage', self::PER_PAGE_DEFAULT);
        $products = $query->paginate($perPage);

        $this->updateSelected($products->getCollection());

        return $products;
    }

    private function updateSelected($products)
    {
        $selected = $this->selected;
        $this->selected = $products->keyBy('id')
            ->map(function ($product) use ($selected) {
                return [
                    'checked' => $selected[$product->id]['checked'] ?? false,
                    'quantity' => $selected[$product->id]['quantity'] ?? 1,
                    'price' => $product->price,
                ];
            })->toArray();

        $this->updateTotals();
    }

    private function updateTotals()
    {
        $checked = collect($this->selected)->filter->checked;
        $this->totals = [
            'sum' => $checked->map(fn($el)=>$el['quantity']*$el['price'])->sum(),
            'quantity' => $checked->map->quantity->sum(),
            'rrc'=> $checked->map(fn($el)=>$el['quantity']*$el['price_rrc'])->sum(),
            'opt'=> $checked->map(fn($el)=>$el['quantity']*$el['price_wholesale'])->sum(),
        ];

        $this->updateSelectAll();
    }

    private function updateSelectAll()
    {
        $this->selectAll = count(array_unique(array_column($this->selected, 'checked'))) === 1;
    }
}
