<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ClientCartController extends Controller
{
    public function cart()
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('client.cart.index');

    }
}
