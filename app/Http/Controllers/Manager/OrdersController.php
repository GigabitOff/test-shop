<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;

class OrdersController extends Controller
{
    public function index()
    {
        Gate::any(['asDirector', 'asManager', 'asHeadManager']) ?: abort(403);
        return view('livewire.manager.orders.index');
    }

    public function show(Order $order)
    {
        Gate::any(['asDirector', 'asManager', 'asHeadManager']) ?: abort(403);
        return view('livewire.manager.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        Gate::any(['asDirector', 'asManager', 'asHeadManager']) ?: abort(403);

        if ($edited = $order->editedCopy) {
            return view('livewire.manager.orders.edit', ['order' => $edited]);
        }

        return redirect()->route('manager.orders.show', ['order' => $order->id]);
    }

    public function create()
    {
        Gate::any(['asDirector', 'asManager', 'asHeadManager']) ?: abort(403);
        return view('livewire.manager.orders.create');
    }
}
