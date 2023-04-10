<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;

class OrdersController extends Controller
{
    public function index()
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.customer.orders.index');
    }

    public function show(Order $order)
    {

        Gate::any(['asCustomerRegistered']) ?: abort(403);
        if(auth()->user()->id != $order->customer_id)
        abort(404);

        //if()
        return view('livewire.customer.orders.show', ['order' => $order]);
    }

    public function edit(Order $order)
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);

        if (auth()->user()->id != $order->customer_id)
        abort(404);

        if ($edited = $order->editedCopy) {
            return view('livewire.customer.orders.edit', ['order' => $edited]);
        }
        return redirect()->route('customer.orders.show', ['order' => $order->id]);
    }

    public function create()
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.customer.orders.create');
    }
}
