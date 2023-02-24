<?php

namespace App\Http\Livewire\Customer\Widget;

//use App\Models\Product;
use App\Models\User;
//use App\Services\UsersService;
use App\Models\Order;
use App\Models\OrderStatusType;
use Livewire\Component;

class RecommendedWidgetLivewire extends Component
{
    protected ?User $customer;

    public function boot()
    {
        $this->customer = auth()->user();
    }

    public function render()
    {
        /** @var UsersService $service */

//        $service = app(UsersService::class);
//
//        $query = $service->customerPersonalOffersQuery($this->customer);
//
//        $subIds = $query->select('id')->toRawSql();
//
//
//        $products = Product::query()
//                ->orWhereHas('personalOffers', fn($q1) => $q1->whereInRaw('id', $subIds))
//                ->withTranslation()
//                ->select('id', 'articul')
//                ->inRandomOrder()
//                ->take(3)->get();

        $recomendedOrders = Order::query()->select('id')
                 ->where('customer_id', $this->customer->id)
                 ->where('status_id', OrderStatusType::STATUS_DRAFT)
                 ->with(['products'=>function($q){
                 $q->select('id','articul','slug');
                 }])->get();

        return view('livewire.customer.widget.recommended-widget-livewire', [
//            'products' => $products,
              'recomendedOrders'=> $recomendedOrders,
        ]);
    }


}
